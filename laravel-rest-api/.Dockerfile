# Imatge base: utilitzem una imatge oficial de PHP amb Apache per a executar Laravel
FROM php:8.4-apache

# Instal·lar dependències necessàries (com extensions de PHP)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Configura el document root de Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Copiar fitxers del projecte a l'ubicació del contenidor
COPY . /var/www/html/

# Canviar els permisos dels fitxers copiats per assegurar-nos que Apache pot accedir-hi
RUN chown -R www-data:www-data /var/www/html

# Instal·lar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Exposar el port 80 per poder accedir-hi
EXPOSE 80

# Configurar el contenidor per executar Apache
CMD ["apache2-foreground"]