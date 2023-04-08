# laravel9使用時にはphpを8~以上にする必要あり
FROM php:8.1-fpm-buster

EXPOSE 5173

RUN apt-get update && apt-get install -y \
    bash git nodejs npm libzip-dev libpng-dev autoconf busybox-static && \
    apt-get install -y libicu-dev && \
    git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install sockets && \
    docker-php-ext-install gd && \
    docker-php-ext-install redis && \
    docker-php-ext-install intl && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-enable opcache

# laravel9使用時にはnodeは16以上にする必要あり
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# install composer
COPY --from=composer:2.0.13 /usr/bin/composer /usr/bin/composer

RUN mkdir /app

RUN mkdir /var/spool/cron && mkdir /var/spool/cron/crontabs && echo '* * * * * php /app/artisan schedule:run' > /var/spool/cron/crontabs/root
WORKDIR /app
