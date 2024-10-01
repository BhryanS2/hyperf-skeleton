ID=$(docker ps | grep "docker_mysql_ssl" | awk '{ print $1 }')
docker exec -it $ID bash
