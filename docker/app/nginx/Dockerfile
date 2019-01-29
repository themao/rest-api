FROM nginx

WORKDIR /var/www/

RUN apt-get update -y && \
    apt-get dist-upgrade -y

ADD docker/app/nginx/upstream.conf /etc/nginx/conf.d/
COPY docker/app/nginx/sites-enabled/app.conf /etc/nginx/conf.d/default.conf

RUN usermod -u 1000 www-data
