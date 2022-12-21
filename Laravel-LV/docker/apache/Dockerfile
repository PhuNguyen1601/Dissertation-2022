FROM php:7.4-apache

RUN a2enmod rewrite

RUN apt-get update \
  && apt-get install -y cron libzip-dev git gnupg wget librabbitmq-dev libssh-dev --no-install-recommends \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#install "amqp" and "redis" extension
RUN pecl install amqp redis

# for phpunit --coverage
RUN pecl install xdebug-2.9.8

RUN docker-php-ext-install mysqli zip pdo pdo_mysql exif && docker-php-ext-enable pdo_mysql amqp xdebug redis

# install gd
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN wget https://getcomposer.org/download/2.2.4/composer.phar \
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

COPY config/apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www

CMD ["apache2-foreground"]
