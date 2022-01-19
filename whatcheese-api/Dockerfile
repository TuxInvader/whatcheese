FROM nginx/unit:1.24.0-php8.0
RUN apt-get update && \
    apt-get upgrade -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    debconf-utils libcap2-bin procps iproute2 netcat-openbsd && \
    mkdir -p /var/run/unit /var/lib/unit /var/log/unit && \
    chown -R unit:0 /var/run /var/lib/unit /var/www /var/log/unit && \
    chmod -R g=u /var/run /var/lib/unit /var/www /var/log/unit && \
    setcap 'cap_net_bind_service=+ep' /usr/sbin/unitd && \
    docker-php-ext-install mysqli && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY html /var/www/html
COPY config.json /docker-entrypoint.d/

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["unitd", "--no-daemon", "--control", "unix:/var/run/control.unit.sock"]

