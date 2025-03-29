# Imagen base con PHP
FROM php:8.2-cli

# Instala extensiones necesarias y herramientas del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql dom

# Instala Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /app

# Copia todo el contenido del proyecto
COPY . .

# Instala dependencias de producción
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto del servidor embebido
EXPOSE 8080

# Ejecuta migraciones y lanza el servidor Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
