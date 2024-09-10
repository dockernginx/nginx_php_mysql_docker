# Usa la imagen oficial de PHP con FPM
FROM php:8.1-fpm

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    openssh-server \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Instala la extensión mysqli para PHP
RUN docker-php-ext-install mysqli

# Configura SSH
RUN mkdir /var/run/sshd
RUN echo 'root:Linux123' | chpasswd
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# Crea el usuario pablo
RUN useradd -m -s /bin/bash pablo
RUN echo 'pablo:Linux123' | chpasswd

# Copia la configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Crea el directorio para los archivos de tu aplicación
RUN mkdir -p /var/www/html

# Copia los archivos de tu aplicación PHP
COPY index.php /var/www/html

# Establece los permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Asegúrate de que PHP-FPM se ejecute como www-data
RUN sed -i 's/user = www-data/user = www-data/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/group = www-data/group = www-data/g' /usr/local/etc/php-fpm.d/www.conf

# Expone los puertos 80 y 22
EXPOSE 80 22

# Crea un script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Usa CMD en formato JSON para iniciar los servicios
CMD ["/start.sh"]
