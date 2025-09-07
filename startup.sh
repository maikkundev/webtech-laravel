#!/bin/bash

set -e

echo "Installing Composer dependencies..."
composer install

echo "Installing npm dependencies..."
npm install

echo "Running npm build..."
npm run build

echo "Starting Laravel Sail..."
./vendor/laravel/sail/bin/sail up -d --build

echo "Waiting for containers..."
sleep 10

echo "Running migrations..."
./vendor/bin/sail artisan migrate

echo "Checking for sessions table migration issue..."
if ./vendor/bin/sail artisan migrate:status | grep -q "2025_07_06_134850_create_sessions_table.*Pending"; then
    echo "Fixing sessions table migration..."
    ./vendor/bin/sail artisan tinker --execute="DB::table('migrations')->insert(['migration' => '2025_07_06_134850_create_sessions_table', 'batch' => 1]);"
    ./vendor/bin/sail artisan migrate
fi

echo "Done!"
