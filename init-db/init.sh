#!/bin/bash
set -e

echo "Creando base de datos quipux_transaccional si no existe..."
psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE DATABASE quipux_transaccional;
EOSQL

echo "Ejecutando script en quipux_transaccional..."
psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname=quipux_transaccional < /docker-entrypoint-initdb.d/quipux_transaccional.sql

echo "Creando base de datos quipux_documental si no existe..."
psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE DATABASE quipux_documental;
EOSQL

echo "Ejecutando script en quipux_documental..."
psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname=quipux_documental < /docker-entrypoint-initdb.d/quipux_documental.sql
