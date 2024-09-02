#!/bin/bash
WORKING_DIR="/var/www"

echo "Setup entrypoint"

if [ -d $WORKING_DIR ]; then

  cd $WORKING_DIR || exit

  if ! [ -d ./vendor ];  then
    echo "Vendor does not exist. Composer install..."
    composer install
    php artisan key:generate
  fi

  echo "Setup storage directory tree"
  mkdir -p storage/framework/sessions
  mkdir -p storage/framework/views
  mkdir -p storage/framework/cache

  composer dump-autoload
  chmod -R 777 $WORKING_DIR/storage

  chown -R www-data:www-data $WORKING_DIR/storage

  if [ "$ROLE" = "app" ]; then
      echo "Run migrations"
      php artisan migrate --force

      echo "Run database seeder"
      php artisan db:seed --force
  fi

  echo "Cache clear"
  php artisan optimize

  # remove docker folder
  if [ -d /var/www/docker ] && [ "$APP_ENV" = "production" ]; then
    rm -rd /var/www/docker
  fi

  if [ "$ROLE" = "app" ]; then
    printf "\nEntrypoint script was successful. \n\nStarting PHP-FPM...\n\n"
    php-fpm
  else
    echo "Could not match the container ROLE \"$ROLE\""
    exit 1
  fi

  else
  printf "Error: '%s' directory not found!" $WORKING_DIR
  exit 1
fi
