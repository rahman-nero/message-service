FROM php:8.1-cli

ARG WWWUSER

# Add user
RUN useradd -M $WWWUSER

RUN apt update \
    && apt install -y apt-utils \
    && apt-get install pkg-config

RUN apt update && apt -y install nano

RUN apt-get install -y libmcrypt-dev openssl \
    && apt-get install -y curl \
    && apt-get -y install zip unzip \
    && apt-get install -y libicu-dev \
    && apt-get install -y libonig-dev

RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo
RUN docker-php-ext-install -j$(nproc) mbstring

RUN apt-get clean \
    && apt-get -y autoremove \
    && rm -rf /var/lib/apt/lists/* /usr/share/doc/*

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www