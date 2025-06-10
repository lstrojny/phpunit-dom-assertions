DOCKER_PHP_EXEC := docker compose run --rm --env PHP_CS_FIXER_IGNORE_ENV=1 php

all: csfix static-analysis test
	@echo "Done."

.env: /etc/passwd /etc/group Makefile
	printf "USER_ID=%s\nGROUP_ID=%s\n" `id --user "${USER}"` `id --group "${USER}"` > .env

vendor: .env docker-compose.yml Dockerfile composer.json
	docker compose build --pull
	$(DOCKER_PHP_EXEC) composer update
	$(DOCKER_PHP_EXEC) composer bump
	touch --no-create $@

.PHONY: csfix
csfix: vendor
	$(DOCKER_PHP_EXEC) vendor/bin/php-cs-fixer fix --verbose

.PHONY: static-analysis
static-analysis: vendor
	$(DOCKER_PHP_EXEC) php -d zend.assertions=1 vendor/bin/phpstan analyse $(PHPSTAN_ARGS)

.PHONY: test
test: vendor
	$(DOCKER_PHP_EXEC) php -d zend.assertions=1 vendor/bin/phpunit $(PHPUNIT_ARGS)

.PHONY: clean
clean:
	git clean -dfX
