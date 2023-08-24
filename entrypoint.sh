#!/bin/sh

chmod -R 777 /var/www/storage/
chmod -R 777 /var/www/bootstrap/
cd /var/www; composer install;

MYSQL_CREDS="-h$DB_HOST -P$DB_PORT -u$DB_USERNAME -p$DB_PASSWORD"
while ! mysqladmin ping $MYSQL_CREDS --silent; do
    echo "WAITING MYSQL"
    sleep 1
done

echo "MYSQL WORKING"

SEEDED_ROWS=$(mysql $MYSQL_CREDS  -s -N -e "select count(*) from orders")
if [[ $SEEDED_ROWS > 0 ]]
then
    echo "DATABASE ALREADY WITH INFORMATION"
    php artisan migrate;
else
    echo "NEW DATABASE"
    php artisan migrate --seed;
fi

php-fpm
