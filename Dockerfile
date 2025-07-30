FROM php:7.4-apache

# install extensi yang dibutuhkan
RUN docker-php-ext-install mysqli

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# salin konfigurasi virtual host
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# salin semua project ke /var/www/html
COPY . /var/www/html

# Ubah permision 
RUN chown -R www-data:www-data /var/www/html \
&& chmod -R 755 /var/www/html
