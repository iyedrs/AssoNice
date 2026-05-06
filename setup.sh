#!/bin/bash
set -e

echo "=== 1. Installation de PHP 8.2, Composer, Node, MariaDB ==="
sudo apt-get update
sudo apt-get install -y \
  php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-mysql \
  php8.2-curl php8.2-zip php8.2-bcmath php8.2-dom php8.2-tokenizer \
  composer nodejs npm mariadb-server mariadb-client

echo "=== 2. Démarrage de MariaDB ==="
sudo systemctl enable --now mariadb

echo "=== 3. Création des bases partagées et normalisation de root ==="
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS NiceAssoSport CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS car_net CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
sudo mariadb -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';"
sudo mariadb -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';"
sudo mariadb -e "ALTER USER 'root'@'127.0.0.1' IDENTIFIED BY 'root';"
sudo mariadb -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;"
sudo mariadb -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;"
sudo mariadb -e "FLUSH PRIVILEGES;"

echo "=== 4. Import du dump SQL ==="
sudo mariadb NiceAssoSport < /home/evan/sites/niceassosport/NiceAssoSport_many_to_many_roles.sql

echo "=== 5. Mise à jour du .env pour MariaDB locale partagée ==="
cd /home/evan/sites/niceassosport
sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' .env
sed -i 's/DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=NiceAssoSport/' .env
sed -i 's/DB_USERNAME=.*/DB_USERNAME=root/' .env
sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=root/' .env

echo "=== 6. Installation des dépendances PHP (Composer) ==="
composer install --no-interaction --prefer-dist

echo "=== 7. Installation des dépendances Node ==="
npm install

echo "=== 8. Build des assets ==="
npm run build

echo "=== 9. Permissions de storage ==="
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache 2>/dev/null || true

echo ""
echo "=== TERMINÉ ! Lancement du serveur Laravel... ==="
echo "=== Tomcat reste sur 8081, phpMyAdmin est prévu à part sur 8082 ==="
php artisan serve --host=0.0.0.0 --port=8000
