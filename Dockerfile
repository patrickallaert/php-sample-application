FROM php:7.1-apache
# Cambiar shell para adicionar codigo al website
SHELL ["/bin/bash", "-c"]

# Actualizar paquetes e instalar dependencias
RUN apt update 
RUN apt -y upgrade
RUN apt -y install wget git zip unzip

# Habilitar driver o soporte para Conexion a BD
RUN docker-php-ext-install pdo_mysql

# Habilitar módulo de Apache
RUN a2enmod rewrite

# Copiar proyecto en la ruta de apache2
COPY . /var/www/html/

# Configuración de Apache vhost para la aplicación
RUN echo -e " \
<VirtualHost *:80> \n\
    ServerName sample \n\
    DocumentRoot /var/www/html/web \n\
    <Directory /var/www/html> \n\
        Require all granted \n\
        AllowOverride all \n\
    </Directory> \n\
    php_admin_value include_path "/var/www/html" \n\
    Include /var/www/html/config-dev/vhost.conf \n\
</VirtualHost> \
" > /etc/apache2/sites-available/000-default.conf

# Directorio de trabajo
WORKDIR /var/www/html/

# Ejecutar Makefile, Instalar Composer
RUN make

# Permisos de escritura, directorio LOGS
RUN chgrp -R www-data logs/
RUN chmod -R g+ws logs/