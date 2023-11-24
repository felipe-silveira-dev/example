FROM php:8.2-fpm-alpine

ENV PHPGROUP=laravel
ENV PHPUSER=laravel

RUN adduser -g ${PHPGROUP} -s /bin/sh -D ${PHPUSER}

RUN sed -i "s/user = www-data/user = ${PHPUSER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = ${PHPGROUP}/g" /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/html/public

RUN set -x \
    && apk update \
    && apk upgrade \
    && apk add --no-cache bash git openssh php-cli zlib-dev freetype-dev libpng-dev libjpeg-turbo-dev libzip-dev zip linux-headers

RUN set -x \
    docker-php-ext-install pdo pdo_mysql php-dev opcache bcmath pcntl gd ctype curl dom fileinfo filter hash mbstring tokenizer xml pdo_session pcre xml

RUN set -x \
    && apk add --no-cache pcre-dev ${PHPIZE_DEPS} \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN pecl install xdebug \ && docker-php-ext-enable xdebug
RUN apk del pcre-dev ${PHPIZE_DEPS}

RUN set -x \
    && curl -L https://getcomposer.org/composer.phar -o /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

COPY infra/php/php.ini /usr/local/etc/php/conf.d/prod.ini
COPY infra/php/fpm.conf /usr/local/etc/php-fpm.d/zz-app.conf

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
