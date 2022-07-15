##################### COMMON COMMANDS
docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

memory:
	sudo sysctl -w vm.max_map_count=262144

## Выполнять команду вручную, ибо не срабатывает вот эта запись: (date "+%d_%m_%+_%H_%M")
dump-database:
	docker-compose exec mariadb mysqldump -uroot -proot app > ./backup/backup_database_$(date "+%d_%m_%Y_%H_%M").sql

chown:
	docker-compose exec php-fpm chown -R www-data /var/www/storage
	docker-compose exec php-fpm chmod -R 755 /var/www/storage

###################### BACKEND COMMANDS
key-generate:
	docker-compose exec php-cli php artisan key:generate

laravel-route:
	docker-compose exec php-cli php artisan route:cache

laravel-cache:
	docker-compose exec php-cli php artisan cache:clear

laravel-migrate:
	docker-compose exec php-cli php artisan migrate

laravel-migrate-seed:
	docker-compose exec php-cli php artisan migrate --seed

laravel-storage-link:
	docker-compose exec php-cli php artisan storage:link

prod-install:
	docker-compose exec php-cli composer install --no-dev

dev-install:
	docker-compose exec php-cli composer install

dump:
	docker-compose exec php-cli composer dumpautoload

laravel-tests:
	docker-compose exec php-cli vendor/bin/phpunit

laravel-queue:
	docker-compose exec php-cli php artisan queue:work

laravel-down:
	docker-compose exec php-cli php artisan down

laravel-up:
	docker-compose exec php-cli php artisan up
