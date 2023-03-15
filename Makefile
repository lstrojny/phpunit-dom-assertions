all: csfix static-analysis test
	@echo "Done."

vendor: composer.json
	composer update
	composer bump
	touch vendor

.PHONY: csfix
csfix: vendor
	vendor/bin/php-cs-fixer fix -v

.PHONY: static-analysis
static-analysis: vendor
	vendor/bin/phpstan analyse $(PHPSTAN_ARGS)

.PHONY: test
test: vendor
	vendor/bin/phpunit $(PHPUNIT_ARGS)
