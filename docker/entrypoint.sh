#!/bin/bash

set -e

# Permission on cache folders
chmod -R 775 storage bootstrap/cache || true

# Wait for the database to upload
echo "Waiting for the database to start..."
until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
  sleep 2
done

echo "Database started!"

echo "Installing Composer dependencies."
composer install

echo "Installing Node Dependencies."
npm install

# Run migrations automatically
if php artisan migrate --force; then
    echo "Migrations completed successfully!"
else
    echo "Error running migrations!"
fi

# Run migrations automatically
if php artisan db:seed; then
    echo "Database seeded successfully!"
else
    echo "Error on seed database!"
fi

# Start the Artisan server
php artisan serve --host=0.0.0.0 --port=8000
