# --- ETAPA 1: Compilar Assets (Node) ---
FROM node:20-alpine AS build-assets
WORKDIR /app
COPY . .
RUN npm install && npm run build

# --- ETAPA 2: Servidor PHP ---
FROM php:8.4-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copiar el proyecto completo
COPY . /var/www

# COPIAR LOS ASSETS COMPILADOS DESDE LA ETAPA 1
COPY --from=build-assets /app/public/build /var/www/public/build

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000