FROM php:7.4-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN apt-get update
RUN apt-get remove libpq5
RUN apt-get install -y libonig-dev libpq-dev libzip-dev redis-server

RUN docker-php-ext-install pdo pgsql pdo_pgsql mbstring zip exif pcntl bcmath
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#COPY .docker/conf/.bashrc /root/
#RUN chmod +x /root/.bashrc
#ENTRYPOINT service redis-server start && tail -F /var/log/error.log
#CMD ["php-fpm", "service redis-server start"]
#COPY .docker/conf/start-redis.sh /root/
#RUN chmod +x /root/start-redis.sh
#ENTRYPOINT ["php-fpm"]
#ENTRYPOINT ["service redis-server start"]
#ENTRYPOINT ["docker-php-entrypoint", "/root/start-redis.sh"]
