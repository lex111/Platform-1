#!/bin/sh
# This script will install a new DocsPen instance on a fresh Ubuntu 16.04 server.
# This script is experimental and does not ensure any security.

echo ""
echo -n "Enter your the domain you want to host DocsPen and press [ENTER]: "
read DOMAIN

myip=$(ip addr | grep 'state UP' -A2 | tail -n1 | awk '{print $2}' | cut -f1  -d'/')

export DEBIAN_FRONTEND=noninteractive
sudo apt update
sudo apt install -y git composer nginx redis-server curl php libapache2-mod-php php7.1-fpm php7.1-curl php7.1-mbstring php7.1-ldap php7.1-mcrypt php7.1-tidy php7.1-xml php7.1-zip php7.1-gd php7.1-mysql mysql-server-5.7 mcrypt

# Set up database
echo -n "Enter your the Database password [ENTER]: "
read DB_PASS
mysql -u root --execute="CREATE DATABASE docspen;"
mysql -u root --execute="CREATE USER 'docspen'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -u root --execute="GRANT ALL ON docspen.* TO 'docspen'@'localhost';"

# Download DocsPen
cd /var/www
sudo rm -rf html/
git clone https://github.com/DocsPen/Platform.git --branch master html
sudo chmod -R 777 html/
DOCSPEN_DIR="/var/www/html"
cd $DOCSPEN_DIR

# Install DocsPen composer dependancies
composer install

# Copy and update DocsPen environment variables
cp .env.example .env
sed -i.bak 's/DB_DATABASE=.*$/DB_DATABASE=docspen/' .env
sed -i.bak 's/DB_USERNAME=.*$/DB_USERNAME=docspen/' .env
sed -i.bak "s/DB_PASSWORD=.*\$/DB_PASSWORD=$DB_PASS/" .env
# Generate the application key
php artisan key:generate --no-interaction --force
# Migrate the databases
php artisan migrate --no-interaction --force

# Set file and folder permissions
sudo chown www-data:www-data -R bootstrap/cache public/uploads storage && chmod -R 755 bootstrap/cache public/uploads storage

# Add nginx configuration
sudo curl -s https://raw.githubusercontent.com/DocsPen/Platform/master/nginx > /etc/nginx/sites-available/docspen
sudo sed -i.bak "s/docspen.ga/$DOMAIN/" /etc/nginx/sites-available/docspen
sudo ln -s /etc/nginx/sites-available/docspen /etc/nginx/sites-enabled/docspen

# Remove the default nginx configuration
sudo rm /etc/nginx/sites-enabled/default

# Restart nginx to load new config
sudo service nginx restart

echo ""
echo "Setup Finished, Your DocsPen instance should now be installed."
echo "You can login with the email 'admin@admin.com' and password of 'password'"
echo "MySQL was installed without a root password, It is recommended that you set a root MySQL password."
echo ""
echo "You can access your DocsPen instance at: http://$myip/"