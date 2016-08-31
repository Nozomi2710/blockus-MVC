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
