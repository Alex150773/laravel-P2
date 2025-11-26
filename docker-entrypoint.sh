#!/bin/bash
set -e

# Create .env file from .env.example if it doesn't exist
if [ ! -f ".env" ]; then
    echo "Creating .env file from .env.example..."
    cp .env.example .env
fi

# Install composer dependencies if vendor doesn't exist
if [ ! -d "vendor" ]; then
    echo "Installing composer dependencies..."
    composer install --no-interaction --prefer-dist
fi

# Generate application key if not already present
if ! grep -q "APP_KEY=base64:" .env || grep -q "APP_KEY=$" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Ensure storage and bootstrap/cache directories exist
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

# Set to www-data so the web server can access them
if [ "$(stat -c '%U' /var/www/html 2>/dev/null)" = "root" ]; then
    chown -R www-data:www-data /var/www/html
fi

# Permissions for storage, cache, and vendor
echo "Fixing permissions for host access..."
chown -R www-data:www-data storage bootstrap/cache vendor
chmod -R 777 storage bootstrap/cache vendor

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Execute the main command
exec "$@"