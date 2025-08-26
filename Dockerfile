# Gunakan PHP 8.3 dengan Apache
FROM php:8.3-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Tambahkan konfigurasi PHP custom
COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend kalau ada
RUN npm install && npm run build

# Laravel optimize
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan config:cache

# Storage link
RUN rm -rf public/storage && php artisan storage:link

# Expose port 8080 (sesuai Railway default)
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
