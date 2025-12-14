FROM php:8.2-apache

# Habilitar extensiones necesarias para MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Activar mod_rewrite (por si lo necesitas luego)
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copiar el proyecto
COPY . /var/www/html

# Permisos (evita errores en algunos hosts)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
