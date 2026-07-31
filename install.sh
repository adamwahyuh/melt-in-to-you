#!/bin/bash

echo "Setting up App"

composer install && npm i

if [ ! -f .env]; then
    cp .env.example .env
    echo "Copying env"
fi

echo "Generate Key"
php artisan key:generate

echo "Creating database"
touch database/database.sqlite

php artisan migrate

npm run build

echo "App Ready"