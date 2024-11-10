brew services restart php@8.3
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
cp .env.example .env
npm install
composer install
php artisan key:generate
php artisan migrate:refresh --seed
php artisan lang:publish
npm run prod
npm run dev
php artisan serve
