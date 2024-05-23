FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    git \
    unzip \
    zip \
    libxml2-dev \
    libzip-dev \
    curl \
    && docker-php-ext-install intl pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

COPY ./app /var/www/app

EXPOSE 9000

CMD ["php-fpm"]
