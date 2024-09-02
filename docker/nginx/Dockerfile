FROM nginx:alpine

COPY ./docker/nginx/ssl_gen.sh /ssl_gen.sh
COPY ./docker/nginx/include/ /etc/nginx/include
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /certs/ && \
    apk add --update openssl && \
    rm -rf /var/cache/apk/* && \
    openssl dhparam -out /certs/dhparam.pem 2048 && \
    chmod +x /ssl_gen.sh && \
    cd /etc/nginx && \
    mkdir -p /var/www

RUN ./ssl_gen.sh

WORKDIR /var/www

# Copy Config
COPY docker/nginx/conf.d/* /etc/nginx/conf.d/

# Copy codebase
RUN mkdir -p /var/www/public
COPY ./public /var/www/public

EXPOSE 80 443
CMD [ "nginx", "-g", "daemon off;" ]
