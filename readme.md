# Screenshot

![alt text](https://raw.githubusercontent.com/ivan006/OC_Pardot_Scraper_v2_Latest/master/Untitled.png "Title")

# htaccess

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```
