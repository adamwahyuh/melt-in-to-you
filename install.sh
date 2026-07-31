#!/bin/bash
echo "=========================="
echo "Setting up App"
echo "=========================="

composer install 

npm i

if [ ! -f .env ]; then
    cp .env.example .env
    echo "Copying env"
fi

echo "=========================="
echo "Generate Key"
echo "=========================="

php artisan key:generate

echo "=========================="
echo "Creating database"
echo "=========================="

touch database/database.sqlite

echo "=========================="
echo "Running Migration"
echo "=========================="

php artisan migrate

echo "=========================="
echo "Running npm run build"
echo "=========================="

npm run build

echo "=========================="
echo "Running Test"
echo "=========================="
php artisan test

echo "=========================="
echo "Application Ready"
echo "=========================="
echo "Running Server"
echo "=========================="
php artisan serve