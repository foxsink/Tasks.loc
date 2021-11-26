#!/bin/sh

set -e

ls -la /srv/app

composer install --prefer-dist --no-progress --no-interaction -ao

bin/console fos:js-routing:dump --format=json --target=assets/fos_js_routes.json

mkdir -p var/cache var/log

setfacl -dR -m u:"www-data":rwX -m u:$(whoami):rwX var
setfacl -R -m u:"www-data":rwX -m u:$(whoami):rwX var

echo "running fpm"
exec docker-php-entrypoint "$@"