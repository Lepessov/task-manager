FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    libicu-dev \
    git \
    unzip \
    nginx \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mysqli mbstring xml zip opcache \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -u $uid -ms /bin/bash -g www-data $user

WORKDIR /var/www

COPY ././task-manager .

RUN #chown -R www-data:www-data /var/www && chmod -R 775 /var/www/storage /var/www/bootstrap/cache
COPY --chown=$user:www-data . /var/www

USER $user

EXPOSE 9000

CMD ["php-fpm"]