FROM php:8.1-apache

# Installer PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql
