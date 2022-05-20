#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Wake up docker containers
up:
	docker-compose up -d

# Shut down docker containers
down:
	docker-compose down

# Stop services only
stop:
	docker-compose stop

# Show a status of each container
status:
	docker-compose ps

# Status alias
s: status

# Show logs of each container
logs:
	docker-compose logs

# Restart all containers
restart: down up

# Restart the client container
restart-client:
	docker-compose restart client

# Restart the client container alias
rc: restart-client

# Show the client logs
logs-client:
	docker-compose logs client

# Show the client logs alias
lc: logs-client

# Build and up docker containers
build:
	docker-compose up -d --build

# Build containers with no cache option
build-no-cache:
	docker-compose build --no-cache

# Build and up docker containers
rebuild: down build

# Run terminal of the php container
php:
	docker-compose exec php bash

# Run terminal of the client container
client:
	docker-compose exec client /bin/sh



#-----------------------------------------------------------
# Database
#-----------------------------------------------------------

# Run database migrations
db-migrate:
	docker-compose exec php php artisan migrate

# Migrate alias
migrate: db-migrate

# Run migrations rollback
db-rollback:
	docker-compose exec php php artisan migrate:rollback
    
#-----------------------------------------------------------
# Testing
#-----------------------------------------------------------

# Run phpunit tests
test:
	docker-compose exec php vendor/bin/phpunit --order-by=defects --stop-on-defect

# Run all tests ignoring failures.
test-all:
	docker-compose exec php php artisan test

# Run phpunit tests with coverage
coverage:
	docker-compose exec php vendor/bin/phpunit --coverage-html tests/report

# Run phpunit tests
dusk:
	docker-compose exec php php artisan dusk

# Generate metrics
metrics:
	docker-compose exec php vendor/bin/phpmetrics --report-html=api/tests/metrics api/app


#-----------------------------------------------------------
# Dependencies
#-----------------------------------------------------------

# Install composer dependencies
composer-install:
	docker-compose exec php composer install

# Update composer dependencies
composer-update:
	docker-compose exec php composer update

# Update / install npm dependencies
npm-install:
	docker-compose exec client npm install


#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Copy the Laravel API environment file
env-api:
	cp .env.api api/.env

# Copy the Vue.js environment file
env-client:
	cp .env.client client/.env

# Add permissions for Laravel cache and storage folders
permissions:
	sudo chmod -R 777 api/bootstrap/cache
	sudo chmod -R 777 api/storage

# Permissions alias
perm: permissions

# Generate a Laravel app key
key:
	docker-compose exec php php artisan key:generate --ansi


# PHP composer autoload command
autoload:
	docker-compose exec php composer dump-autoload

# Install the environment
install: build composer-update install-laravel  install-vue env-api migrate env-client



#-----------------------------------------------------------
# Frameworks installation
#-----------------------------------------------------------

# Laravel
install-laravel:
	docker-compose down
	docker-compose up -d
	sudo chown -R ${USER} api
	sudo chmod -R 777 api/bootstrap/cache
	sudo chmod -R 777 api/storage
	docker-compose exec php php artisan --version

# Vue
install-vue:
	sudo chown -R ${USER} client
	cp .env.client client/.env


#-----------------------------------------------------------
# Clearing
#-----------------------------------------------------------

# Shut down and remove all volumes
remove-volumes:
	docker-compose down --volumes

# Remove all existing networks (useful if network already exists with the same attributes)
prune-networks:
	docker network prune

# Clear cache
prune-a:
	docker system prune -a
