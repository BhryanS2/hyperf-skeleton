FROM mysql:8.0.31

RUN mkdir -p /etc/certs

COPY certs/*.pem /etc/certs/
COPY config.d.cnf /etc/mysql/conf.d
COPY create_user.sql  /docker-entrypoint-initdb.d/

RUN chown -R mysql:mysql /etc/certs
