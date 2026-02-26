up:
	docker compose up -d
down:
	docker compose down
restart: down up
cli:
	docker compose exec php-cli bash
fpm:
	docker compose exec php-fpm bash
install:
	docker compose run --rm php-cli composer install
migrate:
	docker compose run --rm php-cli php protected/yiic migrate