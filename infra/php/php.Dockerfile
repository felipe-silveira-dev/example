# Use a imagem base do PHP 8.2 FPM Alpine
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Linux Library
RUN set -x \
    && apk update \
    && apk upgrade \
    && apk add --no-cache bash vim  openssh php-cli zlib-dev freetype-dev libpng-dev libjpeg-turbo-dev libzip-dev zip mysql-client mariadb-connector-c-dev

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP Extension
RUN docker-php-ext-install opcache bcmath exif pdo pdo_mysql zip gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN set -x \
    && apk add --no-cache pcre-dev ${PHPIZE_DEPS} \
    && pecl install redis \
    && docker-php-ext-enable redis


# Copia os arquivos de configuração do PHP
COPY infra/php/php.ini /usr/local/etc/php/conf.d/prod.ini
COPY infra/php/fpm.conf /usr/local/etc/php-fpm.d/zz-app.conf

# Comando padrão ao iniciar o contêiner
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
