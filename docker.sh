#!/bin/bash
timedatectl set-timezone America/Bahia
curl -fsSL https://get.docker.com | sh -
#sudo curl -fsSL "https://github.com/docker/compose/releases/download/1.25.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
apt-get install -y -qq docker-compose
#sudo chmod +x /usr/local/bin/docker-compose
#sudo usermod -aG docker vagrant
usermod -aG docker vagrant
