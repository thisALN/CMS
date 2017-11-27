<?php
//generate/fix .htaccess
$htaccess = "<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /\nRewriteRule ^index\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>";
$hta  = "<IfModule mod_rewrite.c>\nRewriteEngine Off\n</IfModule>";
file_put_contents('.htaccess', $htaccess);
echo "success at home";
file_put_contents('images/.htaccess', $hta);
echo "success at images";
file_put_contents('admin/.htaccess', $hta);
echo "success at admin";
//file_put_contents('admin/images/.htaccess', $hta);
//echo "success at admin images";
?>