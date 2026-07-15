FROM php:8.3-fpm-bookworm

ARG TZ=America/Belem
ENV TZ=${TZ}

RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev libicu-dev libjpeg62-turbo-dev libpng-dev libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl mysqli pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./dockerhero.fpm.conf /usr/local/etc/php-fpm.d/zzz-dockerhero.fpm.conf
COPY ./dockerhero.php.ini /usr/local/etc/php/conf.d/dockerhero.php.ini
COPY ./entrypoint.sh /usr/local/bin/phppa-entrypoint
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN chmod +x /usr/local/bin/phppa-entrypoint \
    && usermod -u 1000 www-data

WORKDIR /opt/work

CMD ["phppa-entrypoint"]
