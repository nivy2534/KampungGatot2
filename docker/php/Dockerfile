FROM php:8.3.11-fpm

# Tambah Node.js ke PHP-FPM image
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    autoconf \
    pkg-config \
    build-essential \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl exif

#RUN pecl install redis-5.3.7 && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

WORKDIR /var/www/html


CMD ["php-fpm"]
