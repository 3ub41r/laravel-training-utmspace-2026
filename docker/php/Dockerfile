# Stage 1: Build dependencies
FROM composer AS vendor_builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader --ignore-platform-reqs

FROM php:8.4-fpm-bookworm

ENV ACCEPT_EULA=Y

# Install prerequisites required for tools and extensions installed later on.
RUN apt-get update \
    && apt-get install -y \
    apt-transport-https curl gnupg2 libpng-dev libzip-dev nano unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    git \
    libcurl4-openssl-dev \
    unixodbc \
    gnupg \
    lsb-release \
    && docker-php-ext-install curl zip pdo pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Install prerequisites for the sqlsrv and pdo_sqlsrv PHP extensions.
RUN curl -sSL -O https://packages.microsoft.com/config/debian/$(grep VERSION_ID /etc/os-release | cut -d '"' -f 2 | cut -d '.' -f 1)/packages-microsoft-prod.deb \
    && dpkg -i packages-microsoft-prod.deb \
    && rm packages-microsoft-prod.deb \
    && apt-get update \
    && apt-get install -y msodbcsql18 mssql-tools18 unixodbc-dev \
    && rm -rf /var/lib/apt/lists/*

# Retrieve the script used to install PHP extensions from the source container.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Install required PHP extensions and all their prerequisites available via apt.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions bcmath ds exif gd intl opcache pcntl pdo_sqlsrv redis sqlsrv zip

RUN <<EOF cat >> /etc/ssl/openssl.cnf
[openssl_init]
ssl_conf = ssl_configuration

[ssl_configuration]
system_default = tls_system_default

[tls_system_default]
MinProtocol = TLSv1
CipherString = DEFAULT@SECLEVEL=0
EOF

# Setting the work directory.
WORKDIR /var/www/html

COPY . .
# Copy the pre-built vendor directory from Stage 1
COPY --from=vendor_builder /app/vendor ./vendor