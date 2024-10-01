#!/bin/bash

CUSTOM_NAME=docker_mysql_ssl
CUSTOM_DIR=$HOME/vhosts/docker_mysql_ssl/mysql
SWARM_IP=127.0.0.1

mkdir -p $CUSTOM_DIR

# Build docker with custom sql scripts
docker build -t $CUSTOM_NAME .

# Creates a swarm so that docker secret can be used locally
docker swarm init --advertise-addr $SWARM_IP

# Creates docker secret for use in your container
read -s -p "Please enter the desired root password: " -r
echo $REPLY | docker secret create db_root_password -

docker service create \
	-p 3306:3306 \
	--network host \
	--name $CUSTOM_NAME \
	--secret db_root_password \
	--mount type=bind,source=$CUSTOM_DIR,destination=/var/lib/mysql \
	-e MYSQL_ROOT_PASSWORD_FILE="/run/secrets/db_root_password" \
	-e MYSQL_ROOT_HOST='%' \
	$CUSTOM_NAME \
	--ssl-ca=/etc/certs/ca.pem \
	--ssl-cert=/etc/certs/server-cert.pem \
	--ssl-key=/etc/certs/server-key.pem \
	--require_secure-transport=ON
