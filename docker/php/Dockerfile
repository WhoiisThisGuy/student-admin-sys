FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt update -y
RUN pecl install -o -f redis && \
    docker-php-ext-enable redis && \
    docker-php-ext-install opcache

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
    build-essential \
    gcc \
    make \
    autoconf \
    libc-dev \
    pkg-config \
    libmagickwand-dev \
    git \
    curl libcurl4-openssl-dev \
    locales \
    vim \
    libpng-dev libxpm-dev \
    libwebp-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev \
    libz-dev \
	libpq-dev \
    libzip-dev \
    libmemcached-dev \
    libldap2-dev libbz2-dev \
    zlib1g-dev libicu-dev g++ \
    libssl-dev libssl-doc libsasl2-dev \
    zip \
    sudo \
    unzip

RUN docker-php-ext-install ldap pdo mysqli pdo_mysql mbstring exif pcntl bcmath zip gd calendar

RUN set -xe && echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Copy Config
COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy codebase
COPY . ./

# Install dependencies
RUN composer install --prefer-dist

# Finish composer
RUN composer dump-autoload --no-scripts --no-dev --optimize

# Finish setup
COPY ./docker/php/entrypoint.sh /scripts/entrypoint.sh

RUN mkdir -p /storage && \
    chmod +x /var/www/artisan && \
    chown -R www-data:www-data /var/www && \
    chown -R www-data:www-data /scripts/ && \
    chmod +x /scripts/entrypoint.sh

ENTRYPOINT ["sh", "/scripts/entrypoint.sh"]
