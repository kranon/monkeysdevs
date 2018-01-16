# Build Core

rm -rf var/cache/de*
rm -rf var/cache/pr*
# rm -rf vendor/*

composer install

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate -n
php bin/console doctrine:fixtures:load -n

php bin/console cache:clear