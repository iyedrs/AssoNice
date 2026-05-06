#!/bin/bash
# Log everything
exec > /tmp/niceasso_install.log 2>&1
set -e

echo "[$(date)] === Début de l'installation ==="

echo "[$(date)] === 1. Installation PHP 8.2, Composer, Node, MariaDB ==="
sudo apt-get update -qq
sudo apt-get install -y \
  php8.2 php8.2-cli php8.2-fpm php8.2-mbstring php8.2-xml php8.2-mysql \
  php8.2-curl php8.2-zip php8.2-bcmath php8.2-dom php8.2-tokenizer \
  php8.2-intl php8.2-gd \
  composer nodejs npm mariadb-server mariadb-client

echo "[$(date)] === 2. Démarrage de MariaDB ==="
sudo systemctl enable mariadb
sudo systemctl start mariadb

echo "[$(date)] === 3. Création DB + normalisation root ==="
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS NiceAssoSport CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS car_net CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
sudo mariadb -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';"
sudo mariadb -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';"
sudo mariadb -e "ALTER USER 'root'@'127.0.0.1' IDENTIFIED BY 'root';"
sudo mariadb -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;"
sudo mariadb -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;"
sudo mariadb -e "FLUSH PRIVILEGES;"

echo "[$(date)] === 4. Import du dump SQL ==="
sudo mariadb NiceAssoSport < /home/evan/sites/niceassosport/NiceAssoSport_many_to_many_roles.sql

echo "[$(date)] === 5. Mise à jour .env ==="
cd /home/evan/sites/niceassosport
sed -i 's/^DB_HOST=.*/DB_HOST=127.0.0.1/' .env
sed -i 's/^DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/^DB_DATABASE=.*/DB_DATABASE=NiceAssoSport/' .env
sed -i 's/^DB_USERNAME=.*/DB_USERNAME=root/' .env
sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=root/' .env

echo "[$(date)] === 6. Composer install ==="
composer install --no-interaction --prefer-dist

echo "[$(date)] === 7. npm install + build ==="
npm install
npm run build

echo "[$(date)] === 8. Permissions ==="
chmod -R 775 storage bootstrap/cache

echo "[$(date)] === INSTALLATION TERMINÉE ! ==="
echo "[$(date)] Lancement de php artisan serve sur http://localhost:8000"
echo "[$(date)] Java/Tomcat reste sur http://127.0.0.1:8081/webcarnet/ et phpMyAdmin sur http://127.0.0.1:8082"

# Signal que c'est fini
touch /tmp/niceasso_install_done

php artisan serve --host=0.0.0.0 --port=8000
