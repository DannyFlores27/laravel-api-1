# 🚀 API CRUD de Clientes con Laravel y Docker

Este proyecto implementa una **API RESTful** para la gestión de clientes
(CRUD) utilizando **Laravel 12** y el entorno de desarrollo **Sail
(Docker Compose)**.\
Está configurado para un entorno **Windows/PowerShell**, priorizando la
estabilidad y la portabilidad a través de contenedores.

------------------------------------------------------------------------

## 📋 Requisitos del Sistema

Para ejecutar este proyecto necesitas:

-   [Git](https://git-scm.com/)
-   [Docker Desktop](https://www.docker.com/products/docker-desktop/)
    (con Docker Compose y soporte WSL2 o Hyper-V)
-   Un cliente HTTP para pruebas (Postman o Insomnia)

------------------------------------------------------------------------

## ⚙️ Configuración e Inicialización

### 1. Preparación del Proyecto

Clona el repositorio e ingresa al directorio:

``` bash
git clone https://github.com/DannyFlores27/laravel-api-1.git
cd laravel-api-1
```

Configura el archivo de entorno:

``` bash
cp .env.example .env
```

------------------------------------------------------------------------

### 2. Configuración de Puerto Estándar

En el archivo `.env`, define el puerto de la aplicación como **8000**:

``` env
# .env
APP_PORT=8000
```

------------------------------------------------------------------------

### 3. Instalación de Dependencias y Arranque

Instala las dependencias de Composer utilizando Docker:

``` bash
docker run --rm     -u "$(id -u):$(id -g)"     -v $(pwd):/var/www/html     -w /var/www/html     laravelsail/php84-composer:latest composer install --ignore-platform-reqs
```

Levanta los contenedores (Laravel `laravel.test` y MySQL `mysql`):

``` bash
docker compose up -d
```

Genera la clave de la aplicación:

``` bash
docker compose exec laravel.test php artisan key:generate
```

------------------------------------------------------------------------

### 4. Inicializar la Base de Datos y Tablas

Ejecuta migraciones desde cero:

``` bash
docker compose exec laravel.test php artisan migrate:fresh
```

⚠️ Si obtienes un error de permisos en `storage/logs`, ejecuta:

``` bash
docker compose exec laravel.test chmod -R 777 storage bootstrap/cache
```

------------------------------------------------------------------------

## 🌐 Uso de la API (Endpoints)

La API base está accesible en:\
👉 `http://localhost:8000`

Todas las rutas tienen el prefijo **/api**.

### Rutas CRUD de Clientes

  ----------------------------------------------------------------------------------
  Método   Endpoint              Descripción                      Respuesta Exitosa
  -------- --------------------- -------------------------------- ------------------
  POST     `/api/clients`        Crea un nuevo cliente            `201 Created`

  GET      `/api/clients`        Obtiene la lista de todos los    `200 OK`
                                 clientes                         

  GET      `/api/clients/{id}`   Obtiene los detalles de un       `200 OK`
                                 cliente                          

  PATCH    `/api/clients/{id}`   Actualiza parcialmente un        `200 OK`
                                 cliente                          

  DELETE   `/api/clients/{id}`   Elimina un cliente               `204 No Content`
  ----------------------------------------------------------------------------------

------------------------------------------------------------------------

## 🧪 Ejemplos de Pruebas con JSON

Usar **Postman o Insomnia** con `Content-Type: application/json`.

### 1. Crear Cliente (POST)

**URL:** `http://localhost:8000/api/clients`

``` json
{
  "name": "Martín Desarrollador",
  "email": "martin.dev@api.com",
  "phone": "999-000-1111"
}
```

------------------------------------------------------------------------

### 2. Actualizar Cliente (PATCH)

**URL:** `http://localhost:8000/api/clients/1`

``` json
{
  "phone": "555-555-5555"
}
```

------------------------------------------------------------------------

### 3. Eliminar Cliente (DELETE)

**URL:** `http://localhost:8000/api/clients/1`

(No requiere cuerpo. Respuesta vacía con código **204**).

------------------------------------------------------------------------

## 🛑 Detener el Entorno Docker

Para detener y liberar recursos:

``` bash
docker compose stop
```

------------------------------------------------------------------------
