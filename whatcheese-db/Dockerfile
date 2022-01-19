FROM debian:buster
RUN set -x && \
    addgroup --system --gid 101 mysql && \
    adduser --system --disabled-login --ingroup mysql --no-create-home --home /nonexistent --gecos "mysql user" --shell /bin/false --uid 101 mysql && \
    apt-get update && \
    apt-get upgrade -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    debconf-utils && \
    echo mariadb-server mysql-server/root_password password stilton1 | debconf-set-selections && \
    echo mariadb-server mysql-server/root_password_again password stilton1 | debconf-set-selections && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    mariadb-server libcap2-bin procps iproute2 netcat-openbsd && \
    mkdir -p /var/lib/mysql /var/run/mysqld && \
    chown -R mysql:0 /var/lib/mysql /var/run/mysqld && \
    setcap 'cap_net_bind_service=+ep' /usr/sbin/mysqld && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY whatcheese.sql /whatcheese.sql
COPY 50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf

RUN service mysql start && \
    sleep 3 && \
    mysql -uroot -pstilton1 -e "CREATE USER whatcheese@localhost IDENTIFIED BY 'moreCheeseLad'; CREATE DATABASE whatcheese; GRANT ALL privileges ON whatcheese.* TO 'whatcheese'@localhost;" && \
    mysql -uroot -pstilton1 -e "CREATE USER root@'%' IDENTIFIED BY 'stilton1'; GRANT ALL privileges ON *.* TO 'root'@'%';" && \
    mysql -uroot -pstilton1 -e "CREATE USER whatcheese@'%' IDENTIFIED BY 'moreCheeseLad'; GRANT ALL privileges ON whatcheese.* TO 'whatcheese'@'%';" && \
    mysql -uroot -pstilton1 -e "flush privileges;" && \
    mysql -uroot -pstilton1 whatcheese < /whatcheese.sql && \
    sleep 3 && \
    service mysql stop

EXPOSE 3306

USER mysql

CMD ["/usr/sbin/mysqld", "--basedir=/usr", "--datadir=/var/lib/mysql", "--plugin-dir=/usr/lib/x86_64-linux-gnu/mariadb19/plugin", "--user=mysql", "--skip-log-error", "--pid-file=/run/mysqld/mysqld.pid", "--socket=/var/run/mysqld/mysqld.sock"]

