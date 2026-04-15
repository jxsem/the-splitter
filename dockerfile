# Defines la imagen base
FROM php:8.4

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y libpng-dev \
    && docker-php-ext-install pdo_mysql 

# Define el directorio de trabajo dentro de linux
WORKDIR /var/www/html

# Copias tu código fuente al contenedor
COPY . .

# Arranca el servidor PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]