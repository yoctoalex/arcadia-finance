FROM nginxinc/nginx-unprivileged:alpine

COPY /nginx/default.conf /etc/nginx/conf.d/
COPY /mortgage/ /usr/share/nginx/html/mortgage/
