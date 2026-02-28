FROM centos:7

# Repos espejo de CentOS 7 antiguos
RUN sed -i 's|mirrorlist=|#mirrorlist=|g' /etc/yum.repos.d/CentOS-Base.repo && \
    sed -i 's|#baseurl=http://mirror.centos.org|baseurl=http://vault.centos.org|g' /etc/yum.repos.d/CentOS-Base.repo

# Instalar Apache y PHP 5.4 con extensiones necesarias
RUN yum -y update && \
    yum -y install epel-release yum-utils wget unzip curl && \
    yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
    yum-config-manager --disable 'remi-php*' && \
    yum-config-manager --enable remi-php54 && \
    yum -y install httpd php php-soap php-pdo php-pgsql php-common php-cli php-xml php-mbstring php-gd php-fpm html2ps && \
    yum clean all

# Ajustes php.ini para tu configuración
RUN sed -i 's/^short_open_tag = .*/short_open_tag = On/' /etc/php.ini && \
    sed -i 's/^display_errors = .*/display_errors = Off/' /etc/php.ini && \
    sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 2M/' /etc/php.ini && \
    sed -i 's/^error_reporting = .*/error_reporting = E_ALL \& ~E_NOTICE/' /etc/php.ini

# Configurar Apache para evitar errores
RUN echo "ServerName localhost" >> /etc/httpd/conf/httpd.conf

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
