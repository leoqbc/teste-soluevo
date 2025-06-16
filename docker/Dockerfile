FROM serversideup/php:8.4-fpm-nginx-alpine as Base

USER root

ARG USER_ID
ARG GROUP_ID

RUN apk update && \
    apk add --no-cache --update linux-headers build-base autoconf

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

RUN composer self-update

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

# RUN rm -rf /usr/local/etc/php/conf.d/serversideup-docker-php.ini

USER www-data
