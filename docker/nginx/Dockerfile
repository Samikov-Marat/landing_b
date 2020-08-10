FROM nginx:1.18.0-alpine

COPY ./default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public

WORKDIR /app/public