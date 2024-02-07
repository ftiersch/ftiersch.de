#!/bin/bash

sudo chown -R www-data:www-data ./*
cp ../../deploy/.env .env

# symlink uploads to not lose them
ln -s "$(pwd)/../../uploads" ./public/storage
rm -rf ./storage/app/public
ln -s "$(pwd)/../../uploads" ./storage/app/public

# symlink logs to not lose them
rm -rf ./storage/logs
ln -s "$(pwd)/../../logs" ./storage/logs

# change ownership for symlinks
chown -h www-data:www-data ./public/storage
chown -h www-data:www-data ./storage/app/public
chown -h www-data:www-data ./storage/logs

rm ../../current
ln -s "$(pwd)/public" ../../current
chown -h www-data:www-data ../../current

php artisan migrate --force

# delete old releases
cd ..
sh -c "ls -1t | tail +3 | xargs rm -rf"
