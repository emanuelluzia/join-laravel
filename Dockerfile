FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
  autoconf \
  build-essential \
  apt-utils \
  zlib1g-dev \
  libzip-dev \
  unzip \
  zip \
  libmagick++-dev \
  libmagickwand-dev \
  libpq-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libonig-dev \
  curl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg=/usr/include/ --enable-gd
RUN docker-php-ext-install gd intl pdo_mysql mysqli zip

RUN pecl install imagick
RUN docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Permissions
RUN mkdir /var/www/storage
RUN mkdir /var/www/storage/framework
RUN mkdir /var/www/storage/framework/views
RUN mkdir /var/www/storage/logs
RUN touch /var/www/storage/logs/laravel.log

RUN chown -R www-data:www-data /var/www/storage

WORKDIR /var/www
