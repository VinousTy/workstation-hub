SHELL=/bin/bash

ifeq ($(OS), Windows_NT)
OS_NAME="Windows"
else
UNAME=$(shell uname)
ifeq ($(UNAME),Linux)
OS_NAME="Linux"
else
ifeq ($(UNAME),Darwin)
OS_NAME="MacOS"
else
OS_NAME="Other"
endif
endif
endif

build:
	docker-compose build --no-cache --force-rm

install:
	cp .env.example .env
	@make build
	@make up
	docker-compose exec app npm install
	docker-compose exec app composer install
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan storage:link
	docker-compose exec app php artisan migrate

up:
	USER_NAME=$(shell id -nu) USER_ID=$(shell id -u) GROUP_NAME=$(shell id -ng) GROUP_ID=$(shell id -g) OS_NAME=$(OS_NAME) docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

ps:
	docker ps

clear:
	docker-compose exec app php artisan config:cache
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:cache
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

generate:
	@make clear
	docker-compose exec app php artisan openapi:generate > docs/openapi.json

format:
	docker-compose exec app ./vendor/bin/pint --config=pint.json

ifeq ($(OS_NAME), "Linux")
shell:
	docker-compose exec app su -s /bin/bash ${shell id -un}
else
shell:
	docker-compose exec app bash
endif