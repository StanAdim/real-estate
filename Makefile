setup:
	@make build
	@make up 
	@make composer-update
build:
	docker compose build 
stop:
	docker compose stop
up:
	docker compose up -d
composer-update:
	docker exec realestate bash -c "composer update"
data:
	docker exec realestate bash -c "php artisan migrate:fresh --seed"
bash:
	docker exec -it realestate bash
start:
	docker compose restart
