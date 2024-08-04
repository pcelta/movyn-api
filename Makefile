.DEFAULT_GOAL := help

# Display help information
.PHONY: help
help:
	@echo "Usage:"
	@echo "  make <target>"
	@echo ""
	@echo "Targets:"
	@echo "  build               Build the Docker images"
	@echo "  start               Start the containers"
	@echo "  stop                Stop the containers"
	@echo "  ssh                 Open the CLI for the php container"
	@echo "  composer-install    Run composer install"

# Build the Docker images
.PHONY: build
build:
	@echo "Building the Docker images..."
	docker build -t movyn-php-fpm .dev/php

.PHONY: start
start:
	@echo "Starting containers..."
	cd .dev && docker-compose up -d && cd ..

.PHONY: stop
stop:
	@echo "Stopping containers..."
	cd .dev && docker-compose stop && cd ..

.PHONY: ssh
ssh:
	@echo "SSHing into the PHP container..."
	docker exec -it php-fpm bash

.PHONY: composer-install
composer-install:
	@echo "SSHing into the PHP container..."
	docker exec -it php-fpm composer install
