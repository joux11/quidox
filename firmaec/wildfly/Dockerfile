# =========================
# Build stage: compilar WARs + JDBC
# =========================
FROM maven:3.9-eclipse-temurin-17 AS build

ARG FIRMADIGITAL_LIBRERIA_REF=3.1.2
ARG FIRMADIGITAL_SERVICIO_REF=3.1.2
ARG FIRMADIGITAL_API_REF=master
ARG PG_JDBC_VERSION=42.7.4

WORKDIR /src

# 0) Libreria (necesaria para compilar servicio)
RUN git clone https://minka.gob.ec/mintel/ge/firmaec/firmadigital-libreria.git
WORKDIR /src/firmadigital-libreria
RUN git checkout ${FIRMADIGITAL_LIBRERIA_REF} || true
RUN mvn -DskipTests clean install

# 1) Servicio
WORKDIR /src
RUN git clone https://minka.gob.ec/mintel/ge/firmaec/firmadigital-servicio.git
WORKDIR /src/firmadigital-servicio
RUN git checkout ${FIRMADIGITAL_SERVICIO_REF} || true
RUN mvn -DskipTests clean package

# 2) API
WORKDIR /src
RUN git clone https://minka.gob.ec/mintel/ge/firmaec/firmadigital-api.git
WORKDIR /src/firmadigital-api
RUN git checkout ${FIRMADIGITAL_API_REF} || true
RUN mvn -DskipTests clean package

# 3) Descargar JDBC PostgreSQL
WORKDIR /tmp
RUN curl -L -o postgresql.jar \
  https://repo1.maven.org/maven2/org/postgresql/postgresql/${PG_JDBC_VERSION}/postgresql-${PG_JDBC_VERSION}.jar


# =========================
# Runtime stage: WildFly
# =========================
FROM quay.io/wildfly/wildfly:35.0.1.Final-jdk17

USER root

# JDBC jar
RUN mkdir -p /opt/jdbc
COPY --from=build /tmp/postgresql.jar /opt/jdbc/postgresql.jar

# CLI scripts
COPY cli/ /opt/cli/

# Deploy WARs
COPY --from=build /src/firmadigital-servicio/target/*.war /opt/jboss/wildfly/standalone/deployments/
COPY --from=build /src/firmadigital-api/target/*.war /opt/jboss/wildfly/standalone/deployments/

# Admin user (opcional)
ENV WILDFLY_ADMIN_USER=admin
ENV WILDFLY_ADMIN_PASS=admin
RUN /opt/jboss/wildfly/bin/add-user.sh ${WILDFLY_ADMIN_USER} ${WILDFLY_ADMIN_PASS} --silent

USER jboss

# Arranque: inicia WildFly, espera running, aplica CLI idempotente, y mantiene el contenedor vivo
CMD ["/bin/bash", "-lc", "\
  /opt/jboss/wildfly/bin/standalone.sh -b 0.0.0.0 -bmanagement 0.0.0.0 & \
  until /opt/jboss/wildfly/bin/jboss-cli.sh -c ':read-attribute(name=server-state)' | grep -q running; do sleep 2; done; \
  /opt/jboss/wildfly/bin/jboss-cli.sh -c --file=/opt/cli/datasource.cli || true; \
  wait -n \
"]