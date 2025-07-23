#!/bin/bash

# Vercel Build Script untuk Laravel
# Script ini akan dijalankan saat build di Vercel

echo "Starting Laravel build process for Vercel..."

# Set environment variables untuk Composer
export COMPOSER_ALLOW_SUPERUSER=1
export COMPOSER_NO_INTERACTION=1
export COMPOSER_MEMORY_LIMIT=-1

# Create necessary directories
mkdir -p /tmp/storage
mkdir -p /tmp/cache
mkdir -p /tmp/sessions
mkdir -p /tmp/views

# Install dependencies dengan optimizations
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force --no-interaction
fi

# Cache Laravel configurations untuk performance
echo "Caching Laravel configurations..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction  
php artisan view:cache --no-interaction

# Clear unnecessary caches
echo "Clearing temporary caches..."
php artisan cache:clear --no-interaction

echo "Build completed successfully!"
echo "Laravel is ready for deployment on Vercel."
