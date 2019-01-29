FROM php:7.2-fpm

ARG DEBUG_IP
ENV DEBUG_IP $DEBUG_IP

WORKDIR /var/www/

RUN apt-get update -y && \
    apt-get dist-upgrade -y && \
    apt-get install -y iputils-ping curl dialog git gnupg htop net-tools vim wget libicu-dev libxml2-dev zlib1g-dev

RUN pecl install apcu apcu_bc xdebug && \
    docker-php-ext-enable apcu xdebug && \
    docker-php-ext-install bcmath intl json mbstring mysqli opcache pdo pdo_mysql xml zip

COPY docker/app/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN sed -i -e "s/{{DEBUG_IP}}/$(echo $DEBUG_IP)/g" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN touch /tmp/xdebug.log
RUN chmod 777 /tmp/xdebug.log

COPY docker/app/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN usermod -u 1000 www-data
USER www-data

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
