FROM postgres:latest

RUN apt-get update

COPY docker-entrypoint-initdb.d /docker-entrypoint-initdb.d

EXPOSE 5432