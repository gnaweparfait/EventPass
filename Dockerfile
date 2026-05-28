FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader


FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

RUN npm run build


FROM php:8.3-cli-alpine

WORKDIR /var/www/html

RUN apk add --no-cache bash libzip-dev oniguruma-dev icu-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath intl

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && php artisan storage:link || true \
    && chmod -R ug+rwx storage bootstrap/cache

EXPOSE 10000

CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
