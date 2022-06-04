FROM tax_management_base as tax_management_dev

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY ./docker/dev/vhost.conf /etc/apache2/sites-available/tax_management.conf

RUN a2ensite tax_management

COPY ./docker/dev/custom-php.ini $PHP_INI_DIR/conf.d/
