all: static-analysis test
	@echo "Done."

vendor: composer.json
	composer update
	touch vendor

.PHONY: static-analysis
static-analysis: vendor
	vendor/bin/phpstan analyse

.PHONY: test
test: vendor
	vendor/bin/phpunit
