FROM php:8.3-cli

WORKDIR /app

# dépendances système
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

# installer composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copier projet
COPY . .

# installer dépendances Laravel
RUN composer install --no-interaction --prefer-dist

# exposer port
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
