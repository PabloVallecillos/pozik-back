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
