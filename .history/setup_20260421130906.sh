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

echo "=== 3. Création de la base de données et de l'utilisateur ==="
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS NiceAssoSport CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
sudo mariadb -e "CREATE USER IF NOT EXISTS 'niceasso'@'localhost' IDENTIFIED BY 'mp';"
sudo mariadb -e "CREATE USER IF NOT EXISTS 'niceasso'@'127.0.0.1' IDENTIFIED BY 'mp';"
sudo mariadb -e "GRANT ALL PRIVILEGES ON NiceAssoSport.* TO 'niceasso'@'localhost';"
sudo mariadb -e "GRANT ALL PRIVILEGES ON NiceAssoSport.* TO 'niceasso'@'127.0.0.1';"
sudo mariadb -e "FLUSH PRIVILEGES;"

echo "=== 4. Import du dump SQL ==="
sudo mariadb NiceAssoSport < /home/evan/niceassosport/NiceAssoSport_many_to_many_roles.sql

echo "=== 5. Mise à jour du .env pour MariaDB locale ==="
cd /home/evan/niceassosport
sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' .env
sed -i 's/DB_PORT=.*/DB_PORT=3306/' .env

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
php artisan serve --host=0.0.0.0 --port=8000
