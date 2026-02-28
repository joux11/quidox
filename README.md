
# 🚨 Proyecto descontinuado

> :warning: **Este proyecto está descontinuado y no recibe soporte.**  
> No está siendo mantenido, No existen actualizaciones, No existe garantía de funcionamiento ni de seguridad.

---

## ⚠️ Advertencia técnica

Este sistema depende de tecnologías **obsoletas y sin soporte oficial**:

- **PHP 5.4** (fin de vida en 2015, sin parches de seguridad).
- **CentOS 7** (fin de soporte en 2024).
- Librerías específicas que solo funcionan en este entorno antiguo.

El uso de este proyecto en producción representa un **alto riesgo de seguridad** y no es recomendable.

---

## ℹ️ Repositorio anterior

- El proyecto de Quipux Comunitario anteriormente se encontraba en el repositorio de Minka con la URL https://minka.gob.ec/quipux-comunitario/quipux-comunitario
- Por temas técnicos y para asignar una institución que sea propietario del Proyecto Comunitario , quien se encargue de, aprobar los Merge Request que la comunidad pueda brindar y dar en cierta parte seguimiento a los aportes que puedan darse por la comunidad , se ha creado un nuevo repositorio con el código fuente que existía en el repositio anterior, el cual es este reposiorio actual.


## ℹ️ Estado actual

- Última versión comunitaria Versión 5.0.3 (04 de septiembre de 2025) (Incluye correción a vulnerabilidades e integración de docker para mayor facilidad en levantar el proyecto).  
- A pesar de que el Mintel estará corrigiendo mas vulnerabilidades que puedan existir , no hay equipo de desarrollo activo ni mantenimiento oficial; por lo cual, se invita a la comunidad de desarrolladores a ser parte del mismo y colaborar con la solución de issues, reportar issues , etc .  

---

## ✅ Recomendación

Si necesitan una solución similar en entornos actuales, se sugiere:

- Migrar a versiones modernas de PHP (8.x en adelante).  
- Utilizar distribuciones de sistemas operativas con soporte vigente.  
- Reemplazar las librerías obsoletas que se usa en el proyecto por alternativas mantenidas.  

# Quipux comunitario

Quipux es un sistema basado en el Sistema de Gestión Documental Orfeo en el año 2007, ha sido modificado y adaptado a las necesidades de Instituciones Públicas para la gestión Documental.
La versión comunitaria ha sido adaptado para uso de GADS, Instituciones, Organizaciones, Companías y Empresas.
Licenciado como software Libre, GNU/GPL para la distribución libre, gratuita además de compartir los conocimientos y modificaciones.

# Soporte

* Se recomienda el uso de un software de protección perimetral (WAF, Firewall, etc)
* El Sistema no tiene soporte comunitario.
* Verifique ajustes de seguridad como permisos sobre el sistema operativo, configuración de componentes, etc.

# Garantía

Repudio de garantía" ("Disclaimer of warranty").

No se ofrece ninguna garantía sobre el programa de ninguna clase, expresa o implícita. Usted asume cualquier riesgo referente a la calidad, seguridad y prestaciones del programa. Si el programa se prueba como defectuoso, usted asume el coste de cualquier servicio de reparación o corrección.

# INSTALACIÓN SIN DOCKER (MÉTODO TRADICIONAL)

# Requerimientos
* S.O -> Centos, Ubuntu, Fedora
* Apache
* PostgreSQL
* Git
* PHP 7.4

# Paquetes
* php
* php-soap
* php-pdo
* php-pgsql
* html2ps

# Configuraciones adicionales

Remplace por su dominio o ip local en los siguientes archivos

* cp example.config.php config.php
* cp html_a_pdf/example.config.php html_a_pdf/config.php
* cp html_a_pdf/example.html_a_pdf.wsdl html_a_pdf/html_a_pdf.wsdl

# Configuración de base de datos

Crear dos bases de datos (transacional y documental), descargue los scripts desde:

* https://minka.gob.ec/mintel/ge/quipux/quipuxcomunitario/-/tree/main/init-db/quipux_transaccional.sql

* https://minka.gob.ec/mintel/ge/quipux/quipuxcomunitario/-/tree/main/init-db/quipux_documental.sql


# Requerimientos de Hardware
* Almacenamiento de base de datos anual.

* Servidores de Base de datos

| Tipo | Disco | Memoria GB | Procesador Ghz |
| ------ | ------ | ------ | ------ |
| Transaccional | 30 | 6 | 3.4 | 
| Documental | 8GB | 6 | 2.4 | 

* Servidor Web
Disco 30Gb
Memoria 6Gb
Procesador 3.4 Ghz


Memoria y Procesador son requerimientos mínimos.

# Integración de firmaEC
* Edite el archivo config.php y modifique lo siguiente

Generado en firma
$api_key_token="appquipux"

Edite el archivo include/tx/Tx.php

CONSUMO DE SERVICIO WEB RES, la url es proporcionada de firma

$urlws = "http://segun la configuracion del servicio de firma";

# INSTALACIÓN CON DOCKER

* Pre requisitos: Conocimientos en Docker.
* Tener instalado Docker tanto en el ambiente de desarrollo, ambiente de pruebas, preproducción y producción
* La configuración de los contenedores se encuentra en:

  - [docker-compose.yml](https://minka.gob.ec/mintel/ge/quipux/quipuxcomunitario/-/blob/main/docker-compose.yml)
  - [Dockerfile](https://minka.gob.ec/mintel/ge/quipux/quipuxcomunitario/-/blob/main/web/Dockerfile)

* Adicional para levantar los contenedores , el archivo de Docker compose tiene un entry point que apunta a la carpeta https://minka.gob.ec/mintel/ge/quipux/quipuxcomunitario/-/tree/main/init-db en donde se encuentras los scripts para que Docker cree automaticamente las base de datos  (transacional y documental) que utiliza Quipux Comunitario.


* Para levantar el proyecto hay que tener instalado Docker , ubicarse en la raíz del proyecto y ejecutar el comando:

  - docker-compose build 
  - docker-compose up 

* Con ello se crearan 2 contenedores:

  - quipux-web
  - quipux-db


* Para ingresar al sistema de Quipux Comunitario , ingresamos a la URL:

  - http://127.0.0.1:8080

* Las credenciales de acceso són:

  - USUARIO: administrador
  - CLAVE: 123

* A partir de este punto, la adopción y puesta en marcha del sistema queda bajo la responsabilidad de cada equipo de trabajo, quienes deberán definir la arquitectura más adecuada, implementar las medidas de seguridad perimetral que consideren pertinentes y realizar la configuración del sistema conforme a las necesidades de su entorno.


## 📌 Historial de versiones

| Versión | Fecha       | Descripción breve                           |
|---------|------------|----------------------------------------------|
| 5.0.0   | N/A | Integración con firma electrónica. (Se desconoce si actualmente el proyecto funcione con la nueva de Firma EC )   |
| 5.0.1   | N/A | Corrección de problema con versión de Firefox 80   |
| 5.0.2   | N/A| Variables de configuración en config.php, títulos y nueva presentación                |
| 5.0.3       | 2025-09-04          | Mintel pública 29 correciones de vulnerabilidaes en su mayor parte inyecciones sql  |