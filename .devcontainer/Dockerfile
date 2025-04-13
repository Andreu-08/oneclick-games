FROM mcr.microsoft.com/devcontainers/php:1-8.2-bookworm

RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y \
        libpq-dev \
        postgresql-client \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*
