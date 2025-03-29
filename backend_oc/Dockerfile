FROM php:8.2-cli

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql dom

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /app

# Copia todos los archivos del proyecto
COPY . .

# Asegura que dom está disponible
RUN php -m | grep dom || echo "🚨 DOM NO INSTALADO"

# Instala dependencias de Laravel (sin dev en producción)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Ejecuta las migraciones automáticamente en cada despliegue
RUN php artisan config:clear && php artisan cache:clear && php artisan migrate --force || true

# Expone el puerto
EXPOSE 8080

# Inicia Laravel en producción
CMD php artisan serve --host=0.0.0.0 --port=8080
