@echo off
net stop php@8.3
net start php@8.3
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
copy .env.example .env
npm install
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan lang:publish
npm run dev
npm run prod
php artisan serve
pause
