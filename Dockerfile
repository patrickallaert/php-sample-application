# Usamos una imagen oficial de PHP con Apache
FROM php:7.4-apache

# Instalar dependencias del sistema
RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    unzip \
    mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar los archivos de la aplicación
COPY . /var/www/html/

# Establecer permisos adecuados

RUN mkdir -p /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html/logs && \
    chmod -R 775 /var/www/html/logs

RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    chmod -R 775 /var/www/html/

# Configurar Apache
COPY config-dev/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Instalar dependencias de Composer
WORKDIR /var/www/html
USER www-data
RUN composer install --no-dev --optimize-autoloader
USER root

# Puerto expuesto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
