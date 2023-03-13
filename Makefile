default:

lint:
	./vendor/bin/sail php ./vendor/bin/php-cs-fixer fix

test-lint:
	./vendor/bin/sail php  ./vendor/bin/php-cs-fixer fix -v --dry-run --stop-on-violation --using-cache=no

test:
	./vendor/bin/sail php  ./vendor/bin/php-cs-fixer fix -v --dry-run --stop-on-violation --using-cache=no
	./vendor/bin/sail php artisan test
