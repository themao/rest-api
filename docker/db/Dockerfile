FROM mysql:5.7

VOLUME /var/lib/mysql

RUN echo "[mysqld]" >> /etc/mysql/my.cnf
RUN echo "innodb_use_native_aio=0" >> /etc/mysql/my.cnf
RUN echo "max_allowed_packet=32M" >> /etc/mysql/my.cnf
