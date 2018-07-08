#### 1) NGINX Installation

```sh
	$ sudo apt-get update
	$ sudo apt-get install nginx 
```

#### 2) Allow connections to NGINX

```sh
	$ sudo ufw allow 'nginx http'
```

#### 3) Installation for MySQL

```sh
	$ sudo apt-get install mysql-server
```
#### 4) Installation of PHP

```sh
	$ sudo apt-get install php7.0-fpm php7.0-mysql
```
#### 5) Configure NGINX to use PHP Processor
In order to do this we need to do this on server block level(similar to Apache's virtual hosts). To open the default NGINX server block configuration we need to type in terminal:
```sh
	$ sudo gedit /etc/nginx/sites-available/default
```
Some changes are needed to be done:
* Add index.php as the first value of our index directive so that files named index.php to be served, if available.
* server_name can be modified in order to point to our server's domain name or local IP 
* For actual PHP processing we need to uncomment a segment to the file that handles PHP request. The location will be `~\.php$` location block, the included fastcgi-php.conf snippet, and socket associated with php-fpm.
* We also need to uncomment the location block dealing with .htaccess files. NGINX doesn't process these files. If any of them are found in the document root, they shall not be served.
* After all the changes, we need to reload NGINX in order to make the changes:
```sh
    $ sudo systemctl reload nginx
```
#### 6) Create a PHP file to test the configuration
In order to test the PHP processor we need to:
* Create a test PHP file in our document root:
```sh
    $ sudo gedit /var/www/html/info.php
```
* Paste the following code:
```php
<?php
phpinfo();
?>
```
##### If you recieve the following message, everything is set-up!
```log
Welcome to nginx!
If you see this page, the nginx web server is successfully installed and working. Further configuration is required.

For online documentation and support please refer to nginx.org.
Commercial support is available at nginx.com.

Thank you for using nginx.
```

#### 7) Install Laravel
* To install Laravel we need to download and install Composer:
```sh
	$ sudo apt-get install curl
	$ sudo curl -sS https://getcomposer.org/installer | php
```
* Install composer into bin directory
```sh
	$ sudo mv composer.phar /usr/local/bin/composer
```
* Move to the document root
```sh
	$ cd /usr/share/nginx
```
* In order to create a new Laravel project we need to execute:
```sh
	$ sudo apt-get install php7.0-zip
	$ composer global require "laravel/installer"
	$ sudo apt-get install php-mbstring
	$ sudo apt-get install php7.0-xml	
	$ composer create-project laravel/laravel CyberGhost --prefer-dist
```
* Change user and group ownership for project directory:
```sh
	$ sudo chown -R www-data:www-data CyberGhost/
```
* Move to project directory and change file permissions
```sh
	$ sudo chmod -R 0777 storage/
```
* Create backup for default NGINX configuration and create new configuration for Laravel 
```sh
	$ sudo mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default.old
```
* Create new configuration file
```sh
	$ sudo gedit /etc/nginx/sites-available/default
```
* Paste this configuration
```log
server {
    listen   80; ## listen for ipv4; this line is default and implied
    #listen   [::]:80 default ipv6only=on; ## listen for ipv6

    root /usr/share/nginx/CyberGhost/public;
    index index.html index.htm index.php;

    # Make site accessible from http://localhost/
    server_name localhost;

    location / {
            try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    }

    location ~ /\.ht {
            deny all;
    }
}
```
* Restart NGINX
```sh
	$ sudo systemctl restart nginx
```

##### That's all it should work now!

