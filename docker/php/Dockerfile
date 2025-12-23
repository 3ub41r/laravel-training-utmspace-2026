FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libcurl4-openssl-dev \
    unixodbc \
    unixodbc-dev \
    gnupg \
    lsb-release \
    && docker-php-ext-install curl zip pdo pdo_mysql mbstring exif pcntl bcmath gd

RUN curl https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > /usr/share/keyrings/microsoft.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/microsoft.gpg] https://packages.microsoft.com/ubuntu/22.04/prod jammy main" > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

ENV PATH="$PATH:/opt/mssql-tools/bin"

RUN git config --global --add safe.directory /var/www/html

WORKDIR /var/www/html

CMD ["php-fpm"]
