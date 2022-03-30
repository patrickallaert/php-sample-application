install-dev: composer.phar
	./composer.phar install
	ln --symbolic --no-dereference --force config-dev config

composer.phar:
	wget https://getcomposer.org/download/latest-1.x/composer.phar
	chmod u+x composer.phar
