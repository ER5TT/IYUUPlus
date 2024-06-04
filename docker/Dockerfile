FROM alpine:3.15

LABEL maintainer="E" version="2.1.9"

ARG timezone
ARG app_env=prod

ENV APP_ENV=${app_env:-"prod"} \
    TIMEZONE=${timezone:-"Asia/Shanghai"}

WORKDIR /IYUU
RUN set -ex \
        && sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/' /etc/apk/repositories \
        && apk update \
        && apk add --no-cache \
        ca-certificates \
        curl \
        tar \
        libressl \
        openssl  \
        wget \
        zip \
        unzip \
        git \
        tzdata \
        pcre \
        php7 \
        php7-curl \
        php7-dom \
        php7-json \
        php7-mbstring \
        php7-openssl \
        php7-opcache \
        php7-pdo \
        php7-pdo_sqlite \
        php7-phar \
        php7-pcntl \
        php7-posix \
        php7-simplexml \
        php7-sockets \
        php7-session \
        php7-zip \
        php7-zlib \
        php7-xml \
        && git clone https://github.com/exernest/IYUUPlus.git /IYUU \
        && git config --global pull.ff only \
        && apk del --purge *-dev \
        && wget https://getcomposer.org/composer.phar \
        && mv composer.phar /usr/local/bin/composer \
        && chmod +x /usr/local/bin/composer \
        && { \
            echo "upload_max_filesize=100M"; \
            echo "post_max_size=108M"; \
            echo "memory_limit=1024M"; \
            echo "date.timezone=${TIMEZONE}"; \
        } | tee /etc/php7/conf.d/99-overrides.ini \
        && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
        && echo "${TIMEZONE}" > /etc/timezone \
        && rm -rf /var/cache/apk/* /tmp/* /usr/share/man /usr/share/php7 \
        && cp /IYUU/docker/entrypoint.sh /entrypoint.sh \
        && echo -e "\033[42;37m Build Completed :).\033[0m\n"

EXPOSE 8787
VOLUME ["/IYUU/db", "/IYUU"]
ENTRYPOINT ["/entrypoint.sh"]
