#!/usr/bin/env bash

docker compose up -d

#echo "waiting for database to be available:"
#until [ "`docker exec work-database-1 sh "psql -Usymfony -WChangeMe -l" 2> /dev/null`" ]; do
#    sleep 2;
#    echo "waiting...";
#done;

symfony console doctrine:migrations:migrate -n

# add symfony console doctrine:fixtures:load --append

# run "symfony server:ca:install" first if you want to run the web server with TLS support (then remove the --no-tls flag)
symfony serve -d --no-tls

symfony console cache:clear

exit 0;

# show all the env vars
# symfony var:export --debug

# When running console commands, add the https_proxy env var to make custom domains work:
# https_proxy=http://127.0.0.1:7080 curl https://my-domain.wip
