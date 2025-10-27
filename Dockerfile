# Usa a imagem oficial do PHP 7.3 com Apache
FROM php:7.3-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
        git \
        vim \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql sockets \
    && rm -rf /var/lib/apt/lists/*

# Instala o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Copia a configuração do virtual host para o container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN echo "Listen 3000" >> /etc/apache2/ports.conf \
 && echo "Listen 8090" >> /etc/apache2/ports.conf

# Ativa o módulo rewrite do Apache
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Expõe as portas
EXPOSE 3000 8080 8090