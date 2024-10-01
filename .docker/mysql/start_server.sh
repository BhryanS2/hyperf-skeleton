#!/bin/bash

CUSTOM_DIR=$HOME/vhosts/docker_mysql_ssl/mysql
CUSTOM_NAME=docker_mysql_ssl

docker service create \
	--network host \
	--name $CUSTOM_NAME \
	--secret db_root_password \
	--mount type=bind,source=$CUSTOM_DIR,destination=/var/lib/mysql \
	-e MYSQL_ROOT_PASSWORD_FILE="/run/secrets/db_root_password" \
	-e MYSQL_ROOT_HOST='%' \
	$CUSTOM_NAME \
	--ssl-ca=/etc/certs/ca.pem \
	--ssl-cert=/etc/certs/server-cert.pem \
	--ssl-key=/etc/certs/server-key.pem
