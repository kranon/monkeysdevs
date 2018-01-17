rm -rf var/cache/de*
rm -rf var/cache/pr*

composer install

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

bower install

php bin/console assets:install
php bin/console assetic:dump
php bin/console cache:clear
