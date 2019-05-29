#!/usr/bin/env bash

docker-compose up -d

docker exec task_php php -d memory_limit=3000M /usr/local/bin/composer install
docker exec task_php php /var/www/symfony/bin/console d:m:m
docker exec task_php php /var/www/symfony/bin/console app:load