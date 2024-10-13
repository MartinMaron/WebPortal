#!/bin/bash
echo "Starting the project install script..."

cp .env.example .env

# Reinstall dependencies
echo "Reinstalling npm dependencies..."
npm install

echo "Reinstalling composer dependencies..."
composer install

# Generate a new application key
echo "Generating new application key..."
php artisan key:generate

# Run database migrations and seed the database
echo "Refreshing and seeding the database..."
php artisan migrate:refresh --seed

# Build the frontend assets
echo "Building frontend assets..."
npm run build
npm run prod
npm run dev

# Start the Laravel development server
echo "Starting the Laravel development server..."
php artisan serve

echo "Project install completed successfully!"
