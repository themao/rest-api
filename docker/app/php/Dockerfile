FROM php:7.2-fpm

WORKDIR /var/www/

RUN apt-get update -y && \
    apt-get dist-upgrade -y && \
    apt-get install -y iputils-ping curl dialog git gnupg htop net-tools vim wget libicu-dev

RUN pecl install apcu apcu_bc xdebug && \
    docker-php-ext-enable apcu xdebug && \
    docker-php-ext-install bcmath intl json mbstring mysqli opcache pdo pdo_mysql xml zip

ADD docker/app/php/php.ini /usr/local/etc/php/
COPY docker/app/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

COPY docker/app/php/init /usr/bin/init
RUN chmod +x /usr/bin/init

RUN usermod -u 1000 www-data
USER www-data
