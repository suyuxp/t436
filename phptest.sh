#!/bin/bash

cp -f .env.example .env
php artisan key:generate

sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/g' .env
sed -i 's/DB_HOST=.*/DB_HOST=$DB_HOST/g' .env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/g' .env
sed -i 's/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/g' .env
sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/g' .env
sed -i 's/JWT_KEY=.*/JWT_KEY=$JWT_KEY/g' .env

php artisan migrate

chmod +x vendor/bin/phpunit
chmod +x vendor/phpunit/phpunit/phpunit

vendor/bin/phpunit