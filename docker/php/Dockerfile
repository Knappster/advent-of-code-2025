FROM php:8.4-cli

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends \
    libicu-dev \
    libzip-dev \
    unzip && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    bcmath \
    intl \
    pcntl \
    zip && \
    echo 'memory_limit = 256M' > /usr/local/etc/php/conf.d/memory_limit.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/

WORKDIR /app

ENTRYPOINT [ "php", "aoc" ]