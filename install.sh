mkdir -p /var/www/html/api
cp api/.htaccess /var/www/html/api/
cp api/index.php /var/www/html/api/

rm -rf /var/www/html/vendor
cp -r vendor /var/www/html/vendor
