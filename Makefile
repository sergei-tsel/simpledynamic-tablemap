start:
	php -S localhost:8000 public/index.php

cli-list:
	php cli/exec.php list

migrate-create-db:
	php cli/exec.php migrate:create-db

migrate-run:
	php cli/exec.php migrate:run

migrate-rollback-all:
	php cli/exec.php migrate:rollback

migrate-rollback-one:
	php cli/exec.php migrate:rollback --batch --last-count=1

ecs:
	vendor/bin/ecs check --fix

psalm:
	vendor/bin/psalm

rector:
	vendor/bin/rector process --config=rector.php

rector-dry-run:
	vendor/bin/rector process --dry-run --config=rector.

pre-commit:
	 ln -s ../../hooks/pre-commit .git/hooks/pre-commit
	 chmod +x .git/hooks/pre-commit

clear-logs:
	 @find ./logs -name "error_*.log" -type f -mtime +7 -delete
	 @find ./logs -name "php_errors_*.log" -type f -mtime +7 -delete
