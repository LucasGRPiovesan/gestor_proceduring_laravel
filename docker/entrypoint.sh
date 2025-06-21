#!/bin/bash

set -e

# Permission on cache folders
chmod -R 775 storage bootstrap/cache || true

echo "Installing Composer dependencies."
composer install

echo "Installing Node Dependencies."
npm install

# Run tests
if php artisan test; then
    echo "Tests were run!"
else
    echo "Error on running tests!"
fi

# Wait for the database to upload
echo "Waiting for the database to start..."
until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
  sleep 2
done

echo "Database started!"

# Run migrations automatically
if php artisan migrate; then
    echo "Migrations completed successfully!"
    # Run migrations automatically
    if php artisan db:seed; then
        echo "Database seeded successfully!"
    else
        echo "Error on seed database!"
    fi
else
    echo "Error on running migrations!"
fi


# Start the Artisan server
php artisan serve --host=0.0.0.0 --port=8000
