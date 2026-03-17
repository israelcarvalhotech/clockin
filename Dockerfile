FROM php:8.5-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
WORKDIR /var/www/html
EXPOSE 80