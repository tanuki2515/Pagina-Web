FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Carpeta de trabajo
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Exponer puerto
EXPOSE 10000

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=10000
