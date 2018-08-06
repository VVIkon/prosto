<?php
/**

sudo gedit /etc/apache2/sites-available/prosto.local.conf

<VirtualHost *:80>
ServerName prosto.local
DocumentRoot /home/vvikon/Projects/prosto.local

<Directory /home/vvikon/Projects/prosto.local>
AllowOverride All
Require all granted
</Directory>
</VirtualHost>


sudo a2ensite prosto.local
sudo service apache2 reload

sudo gedit /etc/hosts

127.0.0.1       prosto.local

sudo chmod -R 775 /home/vvikon/Projects/prosto.local
sudo chown -R vvikon:www-data /home/vvikon/Projects/prosto.local



 */