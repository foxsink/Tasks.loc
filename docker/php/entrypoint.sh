#!/bin/sh

set -e

ls -la /srv/app

composer install --prefer-dist --no-progress --no-interaction -ao

bin/console fos:js-routing:dump --format=json --target=assets/fos_js_routes.json

mkdir -p var/cache var/log

setfacl -dR -m u:"www-data":rwX -m u:$(whoami):rwX var
setfacl -R -m u:"www-data":rwX -m u:$(whoami):rwX var

echo "Waiting for db to be ready..."
  ATTEMPTS_LEFT_TO_REACH_DATABASE=6000
  until [ $ATTEMPTS_LEFT_TO_REACH_DATABASE -eq 0 ] || DATABASE_ERROR=$(bin/console doctrine:query:sql "SELECT 1" 2>&1); do
    if [ $? -eq 255 ]; then
      # If the Doctrine command exits with 255, an unrecoverable error occurred
      ATTEMPTS_LEFT_TO_REACH_DATABASE=0
      break
    fi
    sleep 1
    ATTEMPTS_LEFT_TO_REACH_DATABASE=$((ATTEMPTS_LEFT_TO_REACH_DATABASE - 1))
    echo "$DATABASE_ERROR"
  done

  if [ $ATTEMPTS_LEFT_TO_REACH_DATABASE -eq 0 ]; then
    echo "The database is not up or not reachable:"
    echo "$DATABASE_ERROR"
    exit 1
  else
    echo "The db is now ready and reachable"
  fi

  if ls -A migrations/*.php >/dev/null 2>&1; then
    bin/console doctrine:migrations:migrate --no-interaction
  fi

echo "running fpm"
exec docker-php-entrypoint "$@"