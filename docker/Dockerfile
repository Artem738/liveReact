# Dockerfile
# Базовый образ PHP-FPM
FROM php:8.4-fpm

# Устанавливаем дополнительные пакеты
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd exif pdo_mysql zip
    

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка Node.js (LTS версия 20.11.1) и NPM
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs
	
# Проверка версий Node.js и NPM
RUN node -v && npm -v	

# Копируем конфигурационный файл PHP
COPY docker/php/php.ini /usr/local/etc/php/php.ini

# Открываем порт 9000 для PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]
