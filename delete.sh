#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
echo "Starting the project delete script..."

# Clear Laravel caches
echo "Clearing Laravel caches..."
php artisan cache:clear || true
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan event:clear || true
php artisan clear-compiled || true

# Clear Composer cache
echo "Clearing Composer cache..."
composer clear-cache || true

# Clear NPM cache
echo "Clearing NPM cache..."
npm cache clean --force || true

# Remove specific directories and files
echo "Removing specific files and directories..."
rm -rf node_modules \
       vendor \
       public/build \
       .phpunit.result.cache \
       composer.lock \
       package-lock.json \
       public/css/app.css \
       public/js/app.js \
       .env
       #resources/js/**/*.vue \



echo "Project delete completed successfully!"
