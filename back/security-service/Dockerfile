# Используем базовый образ PHP с поддержкой Composer
FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev  \
    zip \
    libzip-dev \
    unzip \
    inetutils-ping \
    wget


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql gd zip simplexml sockets

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions http amqp

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Symfony CLI (если не используете его через volume)
#RUN wget https://get.symfony.com/cli/installer  -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony
# Install symfony CLI (https://symfony.com/download)
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli -y

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем все файлы Laravel
COPY . .
RUN chmod -R 777 /var/www/

#RUN composer require nelmio/cors-bundle
# Устанавливаем зависимости Laravel
RUN composer install --optimize-autoloader

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/ /var/www/public /var/www/var /var/www/vendor/

#RUN php artisan migrate

# Открываем порт
EXPOSE 8000
CMD ["symfony","server:start","--allow-all-ip"]
#CMD ["dockerize", "-wait", "tcp://postgres:5432", "-timeout", "60s", "php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]



