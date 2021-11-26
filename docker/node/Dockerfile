FROM curlimages/curl:7.80.0 as node
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
#RUN curl -sL 'https://unofficial-builds.nodejs.org/download/release/v14.17.3/node-v14.17.3-linux-x86.tar.xz' | xzcat | sudo tar -vx --strip-components=1 -C /usr/local/
RUN sudo apk --no-cache add nodejs npm fcgi
RUN sudo npm install --global yarn