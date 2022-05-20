#!/usr/bin/env bash

docker compose up -d

echo "waiting 10 seconds for database to become available:"
sleep 10;

symfony console doctrine:migrations:migrate -n

# run "symfony server:ca:install" first if you want to run the web server with TLS support (then remove the --no-tls flag)
symfony serve -d --no-tls

symfony console cache:clear

exit 0;