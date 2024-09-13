#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Clear the Laravel configuration cache
echo "Clearing Laravel configuration cache..."
php artisan config:clear

# Run database migrations if needed
php artisan migrate --force

# Execute the container's main process (Apache)
exec "$@"
