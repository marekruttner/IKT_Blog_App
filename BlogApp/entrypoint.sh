#!/bin/bash

# Wait for MySQL to be ready
while ! mysqladmin ping -h"$DB_HOST" --silent; do
    echo "Waiting for database connection..."
    sleep 2
done

# Import the initial SQL data if the database is empty
if [ ! -f /var/lib/mysql/db_initialized ]; then
    mysql -h "$DB_HOST" -u "$DB_USERNAME" "$DB_DATABASE" < /var/www/initial_data.sql
    touch /var/lib/mysql/db_initialized
fi

# Run database migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
