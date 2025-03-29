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

# Instala Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define directorio de trabajo
WORKDIR /app

# Copia el proyecto Laravel
COPY . .

# Instala las dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto que Laravel usará
EXPOSE 8080

# Comando para iniciar Laravel con servidor embebido
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
