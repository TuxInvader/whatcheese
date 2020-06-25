FROM debian:stable-slim
RUN apt-get update && \
    apt-get upgrade -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    debconf-utils && \
    echo mariadb-server mysql-server/root_password password stilton1 | debconf-set-selections && \
    echo mariadb-server mysql-server/root_password_again password stilton1 | debconf-set-selections && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    mariadb-server && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY whatcheese.sql /whatcheese.sql
COPY 50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf

RUN service mysql start && \
    sleep 3 && \
    mysql -uroot -pstilton1 -e "CREATE USER whatcheese@localhost IDENTIFIED BY 'moreCheeseLad';CREATE DATABASE whatcheese;GRANT ALL privileges ON whatcheese.* TO 'whatcheese'@localhost;" && \
    mysql -uroot -pstilton1 -e "CREATE USER whatcheese@'%' IDENTIFIED BY 'moreCheeseLad';GRANT ALL privileges ON whatcheese.* TO 'whatcheese'@'%';" && \
    mysql -uroot -pstilton1 whatcheese < /whatcheese.sql

EXPOSE 3306

COPY main.sh /

ENTRYPOINT ["/main.sh"]

