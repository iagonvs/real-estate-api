FROM php:8.3-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev zip unzip git libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY . /var/www

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --optimize-autoloader --no-dev

EXPOSE 8000

CMD ["php-fpm"]
