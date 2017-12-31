## One Line Installation

```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
```
```
sudo apt install -y git composer apache2 redis-server curl php libapache2-mod-php php7.1-fpm php7.1-curl php7.1-mbstring php7.1-ldap php7.1-mcrypt php7.1-tidy php7.1-xml php7.1-zip php7.1-gd php7.1-mysql mysql-server-5.7 mcrypt phpmyadmin
```

## Apache Conf

```
cd /etc/apache2/sites-available
sudo nano docspen.conf
```

```
<VirtualHost *:80>
    ServerName DocsPen

    ServerAdmin yoginth@aol.com
    DocumentRoot /var/www/html/public

    <Directory /var/www/html>
        AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

```
sudo a2dissite 000-default.conf
sudo a2ensite docspen.conf
sudo a2enmod rewrite
sudo service apache2 restart
```
