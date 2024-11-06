# Clear various caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches and optimize
php artisan config:cache
php artisan route:cache
php artisan optimize:clear
php artisan view:cache
php artisan optimize

php artisan serve
