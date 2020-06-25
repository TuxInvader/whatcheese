FROM nginx/unit:1.17.0-php7.3
RUN apt-get update && \
    apt-get upgrade -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php-mysql \
    && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY html /var/www/html
COPY config.json /docker-entrypoint.d/

RUN chown www-data:www-data -R /var/www/html

EXPOSE 80

