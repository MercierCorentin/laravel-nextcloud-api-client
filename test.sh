# !/bin/bash

php -dxdebug.mode=coverage ./vendor/bin/phpunit --configuration phpunit.xml --coverage-php coverage/group_creation.cov --group creation
php -dxdebug.mode=coverage ./vendor/bin/phpunit --configuration phpunit.xml --coverage-php coverage/group_no_modif.cov --group no_modif,modif
php -dxdebug.mode=coverage ./vendor/bin/phpunit --configuration phpunit.xml --coverage-php coverage/group_delete.cov --group delete
phpcov merge coverage --html report