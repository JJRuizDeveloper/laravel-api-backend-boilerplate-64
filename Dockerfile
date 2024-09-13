# Utiliza la última versión de PHP con Apache
FROM php:8.3-apache

# Instala las extensiones necesarias de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Habilita el módulo de Apache rewrite
RUN a2enmod rewrite

# Copia el archivo de configuración de Apache para el sitio
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de la aplicación al contenedor
COPY . .

# Instala Composer y las dependencias de la aplicación
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Ajusta permisos para las carpetas de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar script con instrucciones custom previas al arranque
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Permitir ejecución de script con instrucciones custom
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expone el puerto 80
EXPOSE 80

# Instrucción para ejecutar instrucciones custom antes de iniciar el proceso principal
ENTRYPOINT ["docker-entrypoint.sh"]

# Instrucción para arrancar Apache cuando se ejecute el contenedor
CMD ["apache2-foreground"]
