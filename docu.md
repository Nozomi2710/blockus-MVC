#環境安裝
###安裝VM Virtual Box

download [Virtual Box](http://www.virtualbox.org/)

Z:\5研發二處\應用技術部\0共用\Linux\linuxmint-17.1-cinnamon-64bit
####安裝選擇
   -  選擇ubuntu 64bit
  
   -  硬碟：40G 固定大小
  
   -  切割於D:\，如僅有C:\則使用C:\
  
   -  CPU：可給4顆 
  
   -  memory：4096MB
  

####啟動VM後步驟

   -  打開機器，使用光碟檔啟動
  
   -  進入畫面後點擊光碟
  
   -  皆點擊繼續
  
   -  時區選擇Taipei
  
   -  建立帳號密碼
  
   -  安裝完重啟
  
###安裝nignx
```terminal
sudo apt-get install nginx
sudo /etc/init.d/nginx start (或 service nginx start)
sudo apt-get install php5-cli php5-cgi mysql-server php5-mysql
sudo apt-get install php5-fpm
```

新版的laravel為了配合php會需要更高的版本，一般安裝下的php 5.5.9會低於要求的版本

可以先更新版本

```php
sudo add-apt-repository ppa:ondrej/php5-5.6 -y
sudo apt-get update
sudo apt-get install php5-fpm -y
php –v
```
查看版本是5.6.23

```terminal
sudo vi /etc/nginx/sites-enabled/default
```
將其中的server{...}內容改為
>server {

>  listen 80 default_server;
  
>  listen [::]:80 default_server;

>	# Your project path
	
>  root /home/_userName_/localFolder/public;

>  index index.html index.php index.htm index.nginx-debian.html;

>  server_name _;

>  location / {
  
>      try_files $uri $uri/ =404 /index.php?$query_string;
      
>  }

>  location ~ (.+\.php)$ {
  
>      client_max_body_size 64M;

>      alias /home/_userName_/localFolder/public/$1;

>      fastcgi_split_path_info ^(.+\.php)(/.+)$;

>      include fastcgi_params;
      
>      fastcgi_index index.php;
      
>      fastcgi_param SCRIPT_FILENAME /home/_userName_/localFolder/public/$1;
      
>      fastcgi_pass unix:/var/run/php5-fpm.sock;
      
>  }
  
>}
