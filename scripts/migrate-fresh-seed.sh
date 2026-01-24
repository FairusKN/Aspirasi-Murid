#!/bin/fish

docker exec -it aspirasi_murid-php-1 php artisan migrate:fresh --seed
