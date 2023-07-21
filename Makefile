.PHONY: up
up:
	./vendor/bin/sail up -d

.PHONY: restart
restart:
	./vendor/bin/sail restart

.PHONY: status
status:
	./vendor/bin/sail ps

.PHONY: stop
stop:
	./vendor/bin/sail stop

.PHONY: down
down:
	./vendor/bin/sail down

.PHONY: migrate-fresh-testing
migrate-fresh-testing:
	./vendor/bin/sail artisan migrate:fresh --env=testing --seed

.PHONY: test
test:
	./vendor/bin/sail test

.PHONY: key-generate
key-generate:
	php artisan key:generate

.PHONY: action-install
action-install:
	composer install --no-ansi --no-interaction --no-scripts --no-suggest --no-progress --prefer-dist

.PHONY: doc
doc:
	./vendor/bin/sail artisan scribe:generate
