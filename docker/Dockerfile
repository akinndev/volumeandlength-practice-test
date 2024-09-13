FROM php:8.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install npm, nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Config root path source
WORKDIR /var/www
COPY . /var/www

# Run PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Run npm dependencies
RUN npm install

# Config permission for public & storage folders
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expose port outside
EXPOSE 9000

CMD ["php-fpm"]