#!/usr/bin/env bash

cd /var/www

# Composer install
composer install --no-interaction --no-suggest --no-scripts

# fixing ownership issues
chown -R www-data /var/www

bin/console doctrine:database:create --if-not-exists --no-interaction
bin/console doctrine:migrations:migrate --no-interaction -q
exec bin/console server:run --env=dev 0.0.0.0:8000
