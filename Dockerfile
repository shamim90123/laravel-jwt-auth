# Base image
FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy Laravel files to the container
COPY . .

# Set file permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set Laravel application key
RUN php artisan key:generate

# Expose port 8080
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]

