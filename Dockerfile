FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    default-libmysqlclient-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure mysqli \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Copier le projet
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80