.DEFAULT_GOAL := help
c ?=
dep ?=
path ?=

# Display help information
.PHONY: help
help:
	@echo "Usage:"
	@echo "  make <target>"
	@echo ""
	@echo "Targets:"
	@echo "  build               Build the Docker images\n"
	@echo "  start               Start the containers \n"
	@echo "  stop                Stop the containers \n"
	@echo "  ssh                 Open the CLI for the php container \n"
	@echo "  bin                 Execute the bin/console with a custom arg"
	@echo "                      Example: make bin c=doctrine:mapping:info \n"
	@echo "  composer            Run composer commands"
	@echo "                      Example #1: make composer c='require dep=ramsey/uuid'"
	@echo "                      Example #2: make composer c=install\n"
	@echo "  phpunit             Run the tests"
	@echo "                      Example: make phpunit [path=tests/unit/Entity]"

# Build the Docker images
.PHONY: build
build:
	@echo "Building the Docker images..."
	docker build -t movyn-php-fpm . -f .dev/php/Dockerfile.fpm && docker build -t movyn-composer . -f .dev/php/Dockerfile.composer

.PHONY: start
start:
	@echo "Starting containers..."
	docker-compose up -d

.PHONY: stop
stop:
	@echo "Stopping containers..."
	docker-compose stop

.PHONY: reset
reset:
	@echo "Reseting containers..."
	docker-compose stop && docker-compose rm -f

.PHONY: ssh
ssh:
	@echo "SSHing into the PHP container..."
	docker exec -it php-fpm bash

.PHONY: composer
composer:
	@echo "Running composer $(c)"
	docker run --rm --interactive --tty --volume $(PWD):/app composer $(c)

.PHONY: bin
bin:
	@echo "Executing..."
	docker exec -it php-fpm bin/console $(c)

.PHONY: phpunit
phpunit:
	@echo "Executing the unit tests..."
	docker exec -it php-fpm bin/phpunit $(path)
