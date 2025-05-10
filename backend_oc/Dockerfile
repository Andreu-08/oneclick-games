FROM php:8.2-cli

# Instala extensiones necesarias y herramientas del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el contenido del proyecto
COPY . .

# Instala dependencias de producción
RUN composer install --no-dev --optimize-autoloader

# Establece permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto usado por el servidor embebido de Laravel
EXPOSE 8080

# Comando por defecto: migraciones + servidor Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
