# FROM registry.gitlab.com/mova-general/images/mysql:8.0.31 as builder

# # That file does the DB initialization but also runs mysql daemon, by removing the last line it will only init
# RUN ["sed", "-i", "s/exec \"$@\"/echo \"not running $@\"/", "/usr/local/bin/docker-entrypoint.sh"]

# # needed for intialization
# ENV MYSQL_ROOT_PASSWORD=root
# ENV MYSQL_USER=mova
# ENV MYSQL_PASSWORD=mova

# COPY setup.sql /docker-entrypoint-initdb.d/

# # Need to change the datadir to something else that /var/lib/mysql because the parent docker file defines it as a volume.
# # https://docs.docker.com/engine/reference/builder/#volume :
# #       Changing the volume from within the Dockerfile: If any build steps change the data within the volume after
# #       it has been declared, those changes will be discarded.
# RUN ["/usr/local/bin/docker-entrypoint.sh", "mysqld", "--datadir", "/initialized-db"]

FROM registry.gitlab.com/mova-general/images/mysql:8.0.31

# COPY --from=builder /initialized-db /var/lib/mysql

ENV MYSQL_ROOT_PASSWORD=root

RUN mysql -u root -proot -e "Show databases;"

RUN mysql -u root -proot -e "CREATE USER 'user'@'%' IDENTIFIED BY 'user' REQUIRE X509;"
RUN mysql -u root -proot -e "GRANT ALL PRIVILEGES ON userdb.* TO 'user'@'%';"
RUN mysql -u root -proot -e "FLUSH PRIVILEGES;"
