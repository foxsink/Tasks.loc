FROM i386/alpine:3.15 as node
WORKDIR /srv/app
USER root
COPY entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint
RUN adduser -D node \
    && mkdir /etc/sudoers.d/ \
    && echo "node ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/node \
    && chmod 0440 /etc/sudoers.d/node \
    && apk add sudo
USER node
RUN sudo apk --no-cache add nodejs npm fcgi
RUN sudo npm install --global yarn