NiceAssoSport

Installation:
bash setup.sh

Serveur web:
php artisan serve --host=0.0.0.0 --port=8000

URL:
http://127.0.0.1:8000

MariaDB:
sudo systemctl start mariadb

Base:
127.0.0.1:3306
database: NiceAssoSport
user: root
password: root

phpMyAdmin:
php -S 127.0.0.1:8082 -t /usr/share/phpmyadmin

URL phpMyAdmin:
http://127.0.0.1:8082

Import SQL:
mariadb -uroot -proot NiceAssoSport < NiceAssoSport_many_to_many_roles.sql
