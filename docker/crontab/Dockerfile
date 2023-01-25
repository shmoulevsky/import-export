FROM php:8.0.9-fpm-alpine

RUN apk add --no-cache mysql-client git msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu bash git nodejs npm atop

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql && \
    apk del build-essentials && rm -rf /usr/src/php*

RUN apk add --no-cache ${PHPIZE_DEPS} imagemagick imagemagick-dev
RUN pecl install -o -f imagick\
    &&  docker-php-ext-enable imagick

RUN apk del --no-cache ${PHPIZE_DEPS}

WORKDIR /app

COPY crontab /etc/crontabs/root

CMD ["crond", "-f"]
