FROM nginx:1.23.1
RUN rm /etc/nginx/conf.d/default.conf
COPY .docker/nginx/default.conf /etc/nginx/nginx.conf
RUN apt update && apt install -y procps