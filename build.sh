#!/bin/bash

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Create temporary directories
mkdir -p /tmp

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear any old cache
php artisan cache:clear

echo "Build completed successfully!"
