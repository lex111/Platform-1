## One Line Installation

```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
```
```
sudo apt install -y git composer nginx redis-server curl php libapache2-mod-php php7.1-fpm php7.1-curl php7.1-mbstring php7.1-ldap php7.1-mcrypt php7.1-tidy php7.1-xml php7.1-zip php7.1-gd php7.1-mysql mysql-server-5.7 mcrypt phpmyadmin
```
## Database Creation

```
mysql -p -u root
create database docspen;
grant all privileges on docspen.* to 'ryan'@'localhost' identified by "password"; 
```
## Apache Conf

```
cd /etc/nginx/sites-available
sudo nano docspen
```

```
server {
  listen 80;
  listen [::]:80;

  server_name docspen.com;

  root /var/www/html/public;
  index index.php index.html;

  location / {
    try_files $uri $uri/ /index.php?$query_string;
  }
  
  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.1-fpm.sock;
  }
}
```

```
sudo ln -s /etc/nginx/sites-available/docspen /etc/nginx/sites-enabled/docspen
sudo rm /etc/nginx/sites-enabled/default
sudo service nginx restart
```
