# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions required for Laravel and Horizon
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libicu-dev \
    libxslt-dev \
    libzip-dev \
    libsqlite3-dev \
    libreadline-dev \
    libedit-dev \
    libsqlite3-dev \
    libbz2-dev \
    libgmp-dev \
    libmcrypt-dev \
    libpq-dev \
    libpspell-dev \
    libsnmp-dev \
    libtidy-dev \
    libxslt-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libicu-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip mbstring exif pcntl bcmath sockets opcache intl xml xsl soap

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
