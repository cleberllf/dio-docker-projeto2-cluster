#!/bin/bash
docker swarm init --advertise-addr=192.168.56.11
docker swarm join-token worker | grep docker > /vagrant/worker.sh
docker pull mysql:5.7
docker pull nginx
docker stack deploy -c /vagrant/app/docker-compose.yml projeto2