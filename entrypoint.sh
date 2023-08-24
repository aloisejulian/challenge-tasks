#!/bin/sh

chmod -R 777 /var/www/storage/
chmod -R 777 /var/www/bootstrap/

while ! mysqladmin ping -h$DB_HOST -P$DB_PORT -u$DB_USERNAME -p$DB_PASSWORD --silent; do
    echo "WAITING MYSQL"
    sleep 1
done

echo "MYSQL WORKING"
cd /var/www; composer install;
php artisan migrate
php-fpm
