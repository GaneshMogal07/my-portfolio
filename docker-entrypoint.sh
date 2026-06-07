#!/bin/bash
set -e

# Run package discovery (since we disabled it in composer install build step)
echo "Running package discovery..."
php artisan package:discover --ansi

# Cache configuration, routes, and views
echo "Caching Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
echo "Creating storage symlink..."
php artisan storage:link --force

# Run database migrations in production
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Start Supervisor to run PHP-FPM & Nginx
echo "Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
