#!/bin/sh

set -e

until cgi-fcgi -bind -connect php:9000 > /dev/null 2>&1; do
  >&2 echo "Waiting php..."
  sleep 2
done

yarn install && yarn run dev --watch