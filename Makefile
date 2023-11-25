setup:
	@make build
	@make up
	@make composer-update
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec example-php-1 bash -c "composer update"
migrate:
	docker exec example-php-1 bash -c "php artisan migrate"
