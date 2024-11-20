FROM composer/composer:2-bin AS composer

FROM dunglas/frankenphp:latest

# add additional extensions here:
RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache

# composer
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
COPY --link --from=composer /composer /usr/bin/composer

# Install Node.js and npm
# Specify the desired version of Node.js (e.g., 18.x)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest