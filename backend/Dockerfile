FROM php:8.3-apache
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*
COPY index.php /var/www/html/
EXPOSE 80