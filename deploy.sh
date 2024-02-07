#!/bin/bash

sudo chown -R www-data:www-data ./*
# cp ../../deploy/.env .env

# todo: symlink uploads
# todo: symlink logs

sudo rm ../../current
sudo ln -s public ../../current
sudo chown -h www-data:www-data ../../current

php artisan migrate --force
