FROM php:8.2-apache

# cURL est d?j? pr?sent dans l'image php:8.2-apache
# On active seulement mod_rewrite
RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
