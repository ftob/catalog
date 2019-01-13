#!/usr/bin/env bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE USER catalog;
    CREATE DATABASE catalog;
    GRANT ALL PRIVILEGES ON DATABASE catalog TO catalog;
EOSQL