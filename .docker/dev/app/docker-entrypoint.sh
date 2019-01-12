#!/bin/sh

/usr/bin/composer install

if [ ! -f .env ]; then
    cp .env.example .env
fi

php artisan migrate

printf "\n\nStarting PHP 7.2 daemon...\n\n"

php-fpm --nodaemonize