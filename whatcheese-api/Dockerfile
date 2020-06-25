FROM nginx/unit:1.17.0-php7.3
RUN apt-get update && \
    apt-get upgrade -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    debconf-utils && \
    echo mariadb-server mysql-server/root_password password stilton1 | debconf-set-selections && \
    echo mariadb-server mysql-server/root_password_again password stilton1 | debconf-set-selections && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    mariadb-server \
    php-mysql \
    && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY html /var/www/html
COPY 50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf

RUN chown www-data:www-data -R /var/www/html

EXPOSE 80

COPY main.sh /

ENTRYPOINT ["/main.sh"]

