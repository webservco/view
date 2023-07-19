# Docker + PHP + Composer
#
# https://webservco.github.io/sandbox/Development/Environment/Docker/docker_php_composer_cli/
# Minimal Docker setup for PHP library/package/CLI development.


# Use latest PHP CLI image.
FROM php:8.2-cli

# Update packages and install git.
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

# Install PHP extensions.
# https://github.com/mlocati/docker-php-extension-installer
RUN curl -sSL \
https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
# gd zip
zip

# Setup user in the container.
RUN useradd dev
RUN mkdir -p -m 0700 /home/dev && chown -R dev /home/dev

# Setup project files into the container.
RUN mkdir -p -m 0700 /home/dev/project && chown -R dev /home/dev/project
# Copy files.
COPY . /home/dev/project
RUN chown -R dev /home/dev/project

# Copy Composer binary from official image.
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set working directory.
WORKDIR /home/dev/project
# Set user that runs the commands.
USER dev

# Install composer dependencies
RUN composer update

# Setup compsoer checks as default command.
CMD ["composer", "check:phpcs"]
