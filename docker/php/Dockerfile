FROM i386/php:8.0-fpm-alpine as php

COPY ./docker/php/conf.d/default.ini $PHP_INI_DIR/default.ini
COPY ./docker/php/entrypoint.sh /usr/local/bin/entrypoint

RUN apk add --no-cache libpng libpng-dev acl \
    && docker-php-ext-install gd \
    && chmod +x /usr/local/bin/entrypoint \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /src/app

FROM php as php-dev
COPY ./docker/php/conf.d/dev.ini $PHP_INI_DIR/dev.ini
CMD ["php-fpm"]

FROM php as php-prod
COPY ./ /src/app
COPY ./docker/php/conf.d/prod.ini $PHP_INI_DIR/prod.ini
CMD ["php-fpm"]