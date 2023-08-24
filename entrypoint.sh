#!/bin/sh

chmod -R 777 /var/www/storage/
chmod -R 777 /var/www/bootstrap/
cd /var/www; composer install;
php-fpm
