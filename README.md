# Sistema de Login y API CRUD - Prueba Técnica

Este proyecto es una prueba técnica para crear un sistema de inicio de sesión, un API con operaciones CRUD, y la exportación de datos en formatos .xlsx/.xls, .csv y .txt. Utilizaremos PHP 7.4.23 con el framework CakePHP 4.5 y MySQL como base de datos. El sistema de login encripta contraseñas usando MD5.

## Tabla de Contenidos

1. [Requisitos Previos](#requisitos-previos)
2. [Instalación](#instalación)
3. [Estructura del Proyecto](#estructura-del-proyecto)
4. [Configuración](#configuración)
5. [Ejecución](#ejecución)
6. [API CRUD](#api-crud)
7. [Exportación de Datos](#exportación-de-datos)
8. [Base de Datos](#base-de-datos)
9. [Extra(Swagger)](#swagger)

## Requisitos Previos

Asegúrate de tener instalados los siguientes componentes:

- PHP 7.4.23
- Composer
- MySQL
- Apache Server
- phpMyAdmin (u otro administrador de bases de datos de tu preferencia)
- Git

## Instalación

1. Clona el repositorio desde GitHub:

   ```bash
   git clone https://github.com/JUANSBAQUERO/pruebaTecnica.git

2. Navega al directorio del proyecto "pruebaTecnica/"

3. Ejecuta el comando "composer install"

# Estrutuctura del proyecto

El proyecto conserva la estructura típica de CakePHP con el webroot y las carpetas de controladores, modelos y vistas, en otras palabras MVC

# Ejecución 

# Ejecución en Windows con XAMPP

Si estás utilizando Windows y XAMPP para ejecutar este proyecto, sigue estos pasos:

1. Asegúrate de tener XAMPP instalado en tu sistema. Puedes descargarlo desde [el sitio web de XAMPP](https://www.apachefriends.org/index.html).

2. Clona el repositorio dentro de la carpeta `htdocs` de XAMPP. Puedes encontrar la carpeta `htdocs` en la instalación de XAMPP (por ejemplo, `C:\xampp\htdocs`).

   ```bash
    git clone https://github.com/JUANSBAQUERO/pruebaTecnica.git

3. Asegúrate de que los servicios de Apache y MySQL estén activados. Puedes hacerlo desde la interfaz de usuario de XAMPP

4. Abre tu navegador web y visita http://localhost/pruebaTecnica (o el puerto que estés utilizando) para acceder a la aplicación.

# Ejecución en macOS con MAMP

Si estás utilizando macOS y MAMP para ejecutar este proyecto, sigue estos pasos:

1. Asegúrate de tener MAMP instalado en tu sistema. Puedes descargarlo desde [el sitio web de MAMP](https://www.mamp.info/).

2. Abre la aplicación MAMP y asegúrate de que los servicios de Apache y MySQL estén activados. Puedes hacerlo desde la interfaz de usuario de MAMP.

3. Clona el repositorio dentro de la carpeta `htdocs` de MAMP. Puedes encontrar la carpeta `htdocs` en la instalación de MAMP, generalmente en `Applications/MAMP/htdocs`.

   ```bash
   git clone https://github.com/JUANSBAQUERO/pruebaTecnica.git

4. Abre tu navegador web y visita http://localhost/pruebaTecnica (o el puerto que estés utilizando) para acceder a la aplicación.

# Configuración

La configuración de la base de datos se realiza en config/app_local.php

# Api CRUD

El proyecto incluye un API con operaciones CRUD. Puedes acceder a estas operaciones mediante rutas específicas. Asegúrate de autenticarte correctamente para acceder a las funciones protegidas.

# Exportación de datos

Puedes exportar los datos en los siguientes formatos:

- .xlsx/.xls
- .csv
- .txt

Asegúrate de estar autenticado antes de generar el informe. Los datos exportados serán específicos para el usuario que genera el informe.

# Base de datos

La base de datos se genero en phpMyAdmin.

Se proporciona un archivo de copia/dump de la base de datos en el archivo database_dump.sql. Puedes importar esto en tu base de datos para tener una estructura de tabla inicial.

# Swagger

Si deseas acceder y configurar Swagger para probar los servicios del CRUD, simplemente dirígete a la siguiente URL: http://localhost/pruebaTecnica/swagger.