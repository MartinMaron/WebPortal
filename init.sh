#this scrip is required to run only once after cloning the repository
#if you run this script on production, it will create duplicated config files in the repo root folder
cp .env.example .env
npm install
composer install
php artisan key:generate
php artisan migrate:refresh --seed
composer require laravel/jetstream
php artisan jetstream:install livewire
npm run build
npm run prod
npm run dev
php artisan serve
