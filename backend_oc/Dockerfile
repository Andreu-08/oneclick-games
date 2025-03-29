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

# Limpia caché de Composer por si acaso
RUN composer clear-cache

# Asegura que las extensiones ya están cargadas antes de instalar dependencias
RUN php -m | grep dom || echo "🚨 DOM NO INSTALADO"
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto
EXPOSE 8080

# Comando que arranca Laravel o mantiene el contenedor vivo
CMD php artisan serve --host=0.0.0.0 --port=8080 || tail -f /dev/null
