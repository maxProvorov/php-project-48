install:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src tests
	composer exec --verbose phpstan

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test-json:
	./bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json

test-yml:
	./bin/gendiff tests/fixtures/file1.yml tests/fixtures/file2.yml

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text