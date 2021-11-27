FROM i386/alpine:3.15 as mysql

ARG MYSQL_ROOT_PASS
ARG MYSQL_USER
ARG MYSQL_USER_PASS
ARG MYSQL_DATABASE

COPY ./docker/mysql/entrypoint.sh /usr/local/bin/entrypoint
COPY ./docker/mysql/createuser.sh /usr/local/bin/createuser
COPY ./docker/mysql/my.cnf.d/default.cnf /etc/my.cnf.d/default.cnf

USER root
RUN adduser -D mysql \
    && chmod +x /usr/local/bin/entrypoint \
    && chmod +x /usr/local/bin/createuser \
    && mkdir /etc/sudoers.d/ \
    && echo "mysql ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/mysql \
    && chmod 0440 /etc/sudoers.d/mysql \
    && apk add sudo
USER mysql

RUN sudo apk add mysql mysql-client \
    && sudo mysql_install_db --user=mysql --datadir=/var/lib/mysql --verbose \
    && (sudo /usr/bin/mysqld_safe --user=mysql --datadir='/var/lib/mysql' --port=3306 --verbose &) \
    && sleep 5

ENTRYPOINT ["entrypoint"]

RUN (mysqld &) \
    && sleep 5 \
    && sudo sed -i "s|.*bind-address\s*=.*|bind-address=0.0.0.0|g" /etc/my.cnf.d/mariadb-server.cnf \
    && sudo sed -i "s|.*skip-networking.*|#skip-networking\nport = 3306|g" /etc/my.cnf.d/mariadb-server.cnf \
    && createuser




#CMD ["createuser", "$MYSQL_DATABASE", "$MYSQL_USER", "$MYSQL_USER_PASS", "$MYSQL_ROOT_PASS"]
#RUN sudo rm /etc/my.cnf.d/default.cnf



