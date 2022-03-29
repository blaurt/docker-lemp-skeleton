start:
	@docker-compose up -d

stop:
	@docker-compose down

debug:
	@docker-compose up

restart:
	@docker-compose down && docker-compose up -d

build:
	@docker-compose build

connect-php:
	@docker-compose exec php bash