PHP=$(shell which php)
CURL=$(shell which curl)
CHMOD=$(shell which chmod)
WGET=$(shell which wget)

setup:
	$(PHP) -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
install: setup
	$(PHP) composer.phar install
	$(CHMOD) -R 0777 app/storage
load-class:
	$(PHP) artisan dump-autoload
