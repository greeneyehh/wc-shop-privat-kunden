#!/bin/sh
apt list --upgradable >> /root/update.log
#apt-get update >> /root/update.log
#dpkg --configure -a >> /root/update.log
apt-get upgrade -y >> /root/update.log
#apt-get update >> /root/update.log
#dpkg --configure -a >> /root/update.log
wget https://cloudron.io/cloudron-setup -O /root/cloudron-setup 
chmod +x /root/cloudron-setup >> /root/update.log
/root/./cloudron-setup --skip-reboot >> /root/update.log
