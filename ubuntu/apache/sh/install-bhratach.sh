#!/bin/sh -e

apt-get update
echo ">> Installing dependencies..."
DEBIAN_FRONTEND=noninteractive apt-get -yq -o Dpkg::Options::="--force-confold" install mysql-server-5.6 php5 php5-mysql php5-gd apache2 wget curl


echo ">> Configuring apache..."
apacheSitesEnabled="/etc/apache2/sites-enabled"
apacheWWW="/var/www/localhost/vuln"
apacheetc="/etc/apache2"
chown -R www-data:www-data $apacheWWW
chown -R www-data:www-data "$apacheetc"
update-rc.d apache2 defaults
service apache2 restart


echo ">> Configuring mysql"
cmdmysql="/usr/bin/mysqld_safe"
service mysql start && mysql -u root < /var/www/localhost/vuln/chatchat/mysql_dump
$cmdmysql &
# Wait until mysql is up
while ! netcat -w 1 localhost 3306; do
    sleep 1
done
# Enable general log so we see queries
mysql -e "SET GLOBAL log_output = \"FILE\";SET GLOBAL general_log_file = \"/var/log/mysql/mysqlGen.log\";SET GLOBAL general_log = 'ON';"
