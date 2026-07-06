FROM php:8.2-apache

# Copier ton projet dans le serveur web
COPY . /var/www/html/

# Activer rewrite (utile pour PHP)
RUN a2enmod rewrite

# Permissions correctes
RUN chown -R www-data:www-data /var/www/html