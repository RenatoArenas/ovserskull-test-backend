# Backend Overskull Test

API REST desarrollada con **Laravel 13** para gestionar **categorías** y **productos**. Incluye documentación OpenAPI (Swagger), registro de actividad (Spatie Activity Log) y depuración con Laravel Telescope.

## Requisitos

- **PHP** >= 8.3 con extensiones habituales de Laravel (`openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`)
- **Composer** 2.x
- **Node.js** >= 18 y **npm** (opcional; solo si vas a compilar assets front-end con Vite)
- **SQLite** (configuración por defecto) o **MySQL** / **PostgreSQL** si prefieres otro motor

## Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio> backend-overskull-test
cd backend-overskull-test
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

Copia el archivo de ejemplo y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

Ajusta `APP_URL` en `.env` si el servidor no corre en `http://localhost` (por ejemplo `http://localhost:8000`).

### 4. Base de datos (SQLite por defecto)

El proyecto viene preparado para **SQLite**. Crea el archivo de base de datos y ejecuta las migraciones:

```bash
touch database/database.sqlite
php artisan migrate
```

Opcional: cargar datos de prueba (usuario de ejemplo):

```bash
php artisan db:seed
```

#### Usar MySQL o PostgreSQL

En `.env`, comenta o elimina la configuración de SQLite y define tu conexión, por ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=overskull
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

Crea la base de datos en el servidor y ejecuta `php artisan migrate`.

### 5. Permisos de almacenamiento

Laravel necesita escribir en `storage` y `bootstrap/cache`:

```bash
chmod -R 775 storage bootstrap/cache
```

En entornos locales con tu usuario como propietario suele bastar; en producción asigna el usuario del servidor web (por ejemplo `www-data`).

### 6. Documentación Swagger (OpenAPI)

Genera o actualiza el JSON de la API a partir de las anotaciones en los controladores:

```bash
php artisan l5-swagger:generate
```

### 7. Assets front-end (opcional)

Si necesitas compilar Vite (vistas o assets):

```bash
npm install
npm run build
```

## Instalación rápida (un solo comando)

El proyecto incluye un script de Composer que automatiza los pasos básicos:

```bash
composer setup
```

Esto ejecuta `composer install`, crea `.env` si no existe, genera `APP_KEY`, corre migraciones, instala npm y compila assets.

## Ejecutar el servidor

### Servidor de desarrollo

```bash
php artisan serve
```

La API quedará disponible en `http://127.0.0.1:8000` (prefijo `/api` en las rutas de la API).

### Entorno de desarrollo completo

Inicia servidor, cola, logs y Vite en paralelo:

```bash
composer dev
```

## Endpoints principales

| Método   | Ruta                    | Descripción              |
|----------|-------------------------|--------------------------|
| `GET`    | `/api/categories`       | Listar categorías        |
| `GET`    | `/api/categories/{id}`  | Ver categoría            |
| `POST`   | `/api/categories`       | Crear categoría          |
| `PATCH`  | `/api/categories/{id}`  | Actualizar categoría     |
| `DELETE` | `/api/categories/{id}`  | Eliminar categoría       |
| `GET`    | `/api/products`         | Listar productos         |
| `GET`    | `/api/products/{id}`    | Ver producto             |
| `POST`   | `/api/products`         | Crear producto           |
| `PATCH`  | `/api/products/{id}`    | Actualizar producto      |
| `DELETE` | `/api/products/{id}`    | Eliminar producto        |

Comprueba el estado de la aplicación: `GET /up`

## Documentación interactiva

Con el servidor en marcha:

- **Swagger UI:** [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

Tras cambiar anotaciones en controladores o esquemas, vuelve a ejecutar `php artisan l5-swagger:generate`.

## Laravel Telescope

Panel de depuración (solo recomendado en **local** / **desarrollo**):

- **URL:** [http://127.0.0.1:8000/telescope](http://127.0.0.1:8000/telescope)

Las tablas de Telescope se crean con las migraciones incluidas en el proyecto.

## Pruebas

```bash
composer test
```

o:

```bash
php artisan test
```

## Estructura relevante

```
app/
├── Http/
│   ├── Controllers/     # Controladores API y anotaciones OpenAPI
│   ├── Requests/        # Validación de peticiones
│   ├── Resources/       # Respuestas JSON
│   └── Schemas/         # Esquemas Swagger
├── Models/              # Category, Product
└── Services/            # Lógica de negocio
database/migrations/     # Esquema de base de datos
routes/api.php           # Rutas de la API
```

## Solución de problemas

| Problema | Posible solución |
|----------|------------------|
| `SQLSTATE[HY000]: General error: 14 unable to open database file` | Verifica que exista `database/database.sqlite` y que `storage` tenga permisos de escritura. |
| `No application encryption key` | Ejecuta `php artisan key:generate`. |
| Documentación Swagger vacía o desactualizada | Ejecuta `php artisan l5-swagger:generate`. |
| Error de sesión/caché/cola | Las migraciones crean tablas para `SESSION_DRIVER`, `CACHE_STORE` y `QUEUE_CONNECTION` en modo `database`; asegúrate de haber corrido `php artisan migrate`. |

## Licencia

Proyecto basado en [Laravel](https://laravel.com), licencia [MIT](https://opensource.org/licenses/MIT).
