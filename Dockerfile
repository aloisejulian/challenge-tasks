# We choose PHP 8.1 FPM.
FROM php:8.1-fpm

# Copy the package.json, composer and composer-lock to /var/www/
COPY package.json /var/www/
COPY composer*.json /var/www/

WORKDIR /var/www/

# Install dependecies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Configuration of PHP extensions.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure zip
RUN docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip exif pcntl
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Install MySQL Client
RUN apt-get install -y default-mysql-client

# Install Composer and dependecies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a php.ini and move it.
COPY php.ini /usr/local/etc/php/php.ini

# Copy all files to /var/www
COPY . /var/www/

# Open port 9000 and run php-fpm
EXPOSE 9000

COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
RUN chmod -R 777 /var/www/storage/
CMD ["entrypoint.sh"]
