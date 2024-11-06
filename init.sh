#this scrip is required to run only once after cloning the repository
#if you run this script on production, it will create duplicated config files in the repo root folder
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
composer require laravel/jetstream
composer require laravel/fortify
php artisan fortify:install
php artisan jetstream:install livewire
php artisan vendor:publish --tag=sanctum-migrations
php artisan lang:publish
php artisan migrate
composer dump-autoload
php artisan vendor:publish --all
php artisan optimize:clear
npm run build
npm run prod
npm run dev
php artisan serve
