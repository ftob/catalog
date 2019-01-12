FROM php:7.2.12-fpm-alpine

WORKDIR /usr/app

EXPOSE 9000

VOLUME /usr/app

RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev \
  libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} gd && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN apk update && \
    apk add zlib-dev

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add php7-dev php7-xdebug

COPY docker-entrypoint.sh /usr/bin/docker-entrypoint.sh
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.6.0beta1 \
    && docker-php-ext-enable xdebug


RUN echo xdebug.remote_enable=1 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_port=9000 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_autostart=1 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_connect_back=0 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.idekey=PHP_STORM >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_host=192.168.1.2 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN chmod +x /usr/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/bin/docker-entrypoint.sh"]
