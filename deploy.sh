#!/bin/bash

sudo chown -R www-data:www-data ./*
cp ../../deploy/.env .env

# symlink uploads to not lose them
sudo ln -s "$(pwd)/../../uploads" ./public/storage
sudo rm -rf ./storage/app/public
sudo ln -s "$(pwd)/../../uploads" ./storage/app/public

# symlink logs to not lose them
sudo rm -rf ./storage/logs
sudo ln -s "$(pwd)/../../logs" ./storage/logs

# change ownership for symlinks
sudo chown -h www-data:www-data ./public/storage
sudo chown -h www-data:www-data ./storage/app/public
sudo chown -h www-data:www-data ./storage/logs

sudo rm ../../current
sudo ln -s "$(pwd)/public" ../../current
sudo chown -h www-data:www-data ../../current

php artisan migrate --force
php artisan cache:clear

# delete old releases
old_releases=($(ls -1t .. | tail +3))

for ((i=0; i < ${#old_releases[@]}; i++)); do
  sudo rm -rf "../${old_releases[$i]}"
done
