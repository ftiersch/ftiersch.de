#!/bin/bash

chown -R www-data:www-data ./*
# cp ../../deploy/.env .env

# todo: symlink uploads
# todo: symlink logs

rm ../../current
ln -s public ../../current
chown -h www-data:www-data ../../current

php artisan migrate -f
