# Proyecto Laravel Leads

Este proyecto es una aplicación Laravel diseñada para almacenar y gestionar leads. Utiliza Laravel Sail para la configuración de contenedores y phpMyAdmin para la administración de la base de datos.

## Requisitos Previos

-   Docker
-   Docker Compose

## Instalación

1. **Clonar el repositorio**:

    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd <NOMBRE_DEL_PROYECTO>
    ```

2. **Instalar dependencias**:

    Asegúrate de que tienes el archivo `composer.json` en el directorio del proyecto y ejecuta:

    ```bash
    composer install
    ```

3. **Copiar el archivo de entorno**:

    Copia el archivo `.env.example` a `.env` y configura las variables de entorno necesarias, especialmente las relacionadas con la base de datos.

    ```bash
    cp .env.example .env
    ```

4. **Generar la clave de aplicación**:

    ```bash
    php artisan key:generate
    ```

5. **Configurar Sail**:

    Si aún no lo has hecho, ejecuta Sail para inicializar tu entorno de desarrollo:

    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Ejecutar migraciones**:

    Ejecuta las migraciones para crear la base de datos y las tablas necesarias:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

## Acceso a phpMyAdmin

Después de iniciar los contenedores, puedes acceder a **phpMyAdmin** en:

```
http://localhost:8081
```

-   **Usuario**: `root`
-   **Contraseña**: la que configuraste en `MYSQL_ROOT_PASSWORD` en tu archivo `.env`.

## Uso de la aplicación

-   Puedes interactuar con la API a través de herramientas como **Postman** o **Insomnia**.
-   Asegúrate de que los endpoints están correctamente configurados en tu controlador de API.

## Seeder de Datos

Para poblar la base de datos con datos de ejemplo, puedes ejecutar:

```bash
./vendor/bin/sail artisan db:seed
```

Esto utilizará los seeders definidos en la carpeta `database/seeders`.

## Comandos Útiles

-   **Levantar contenedores**:

    ```bash
    ./vendor/bin/sail up -d
    ```

-   **Detener contenedores**:

    ```bash
    ./vendor/bin/sail down
    ```

-   **Ejecutar comandos de Artisan**:

    ```bash
    ./vendor/bin/sail artisan <comando>
    ```

-   **Acceder al contenedor de la aplicación**:

    ```bash
    ./vendor/bin/sail shell
    ```
