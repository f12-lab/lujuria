FROM debian:bookworm

# Instalación de Apache y PHP-FPM
RUN apt-get update && apt-get install -y \
    apache2 \
    apache2-utils \
    curl \
    libapache2-mod-php \
    php \
    && apt-get clean

# Habilitar los módulos necesarios
RUN a2enmod headers && a2enmod rewrite
RUN service apache2 restart

# Configuramos un VirtualHost en Apache
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Crear el usuario dante
RUN useradd -ms /bin/bash dante && \
    echo "dante:dante123" | chpasswd

# Añadir aplicación vulnerable
RUN mkdir -p /var/www/html/vulnerable-app
COPY apache/vulnerable-app /var/www/html/vulnerable-app
RUN chown -R www-data:www-data /var/www/html/vulnerable-app && chmod -R 755 /var/www/html/vulnerable-app

# Exponer el puerto de HTTP (no HTTPS)
EXPOSE 80

# Comando por defecto al iniciar el contenedor
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
