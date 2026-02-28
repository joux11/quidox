#!/bin/bash

set -e

# Eliminar PID viejo si existe
rm -f /run/httpd/httpd.pid /var/run/httpd/httpd.pid 2>/dev/null || true

# Iniciar PHP-FPM en segundo plano
/usr/sbin/php-fpm --daemonize

# Ejecutar Apache en primer plano (proceso principal del contenedor)
exec /usr/sbin/httpd -DFOREGROUND