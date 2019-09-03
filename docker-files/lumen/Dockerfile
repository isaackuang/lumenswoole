FROM isaackuang/swoole:4.4.4.1

RUN apk --no-cache --progress add \
    php7-json@php php7-tokenizer@php php7-mbstring@php \
    php7-redis@php php7-pdo@php php7-yaml@php php7-mongodb@php

COPY docker-files/lumen/config /

COPY lumen /var/www/html