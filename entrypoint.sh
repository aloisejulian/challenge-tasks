#!/bin/sh

chmod -R 777 /var/www/storage/
php-fpm
cd /var/www/
composer install
