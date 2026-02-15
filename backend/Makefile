# ---------------------------------------------------
# Variables
# ---------------------------------------------------
PHP_ARTISAN=php artisan
COMPOSER=composer

##install new empty app
install: clear-cache composer-install key reset-database
## ---------------------------------------------------
composer-install:
	$(COMPOSER) install --no-interaction --optimize-autoloader
## ---------------------------------------------------
clear-cache:
	$(PHP_ARTISAN) config:clear
	$(PHP_ARTISAN) cache:clear
	$(PHP_ARTISAN) route:clear
	$(PHP_ARTISAN) view:clear
## ---------------------------------------------------
key:
	$(PHP_ARTISAN) key:generate
## ---------------------------------------------------
reset-database:
	$(PHP_ARTISAN) migrate:fresh --seed
