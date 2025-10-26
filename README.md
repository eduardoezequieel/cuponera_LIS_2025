# La Cuponera SV - Fase 1 

Plataforma de cupones donde empresas pueden vender cupones y clientes pueden comprarlos para ahorrar en sus lugares favoritos.

## 🚀 Requisitos Previos

-   **XAMPP** (PHP 8.2 o superior)
-   **Composer** (Gestor de dependencias de PHP)
-   **Node.js** 20.16.0 o superior
-   **Git**

## 📦 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/eduardoezequieel/cuponera_LIS_2025.git
cd cuponera_LIS_2025
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node.js

```bash
npm install
```

### 4. Configurar variables de entorno

Copia el archivo `.env.example` y renómbralo a `.env`:

```bash
cp .env.example .env
```

### 5. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 6. Configurar la base de datos

Este proyecto usa **MySQL con XAMPP**.

**Pasos para configurar:**

1. Inicia **XAMPP** y activa los servicios de **Apache** y **MySQL**

2. Crea la base de datos desde **phpMyAdmin** (http://localhost/phpmyadmin):

    - Haz clic en "Nueva"
    - Nombre de la base de datos: `cuponera`
    - Cotejamiento: `utf8mb4_unicode_ci`
    - Clic en "Crear"

3. Verifica que tu archivo `.env` tenga la siguiente configuración:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cuponera
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto creará las tablas y los siguientes datos iniciales:

-   **Roles**: admin, empresa, cliente
-   **Usuario Admin**:
    -   Email: `admin@admin.com`
    -   Password: `admin123`

### 8. Iniciar el servidor de desarrollo

Necesitas **dos terminales** abiertas:

**Terminal 1 - Servidor Laravel:**

```bash
php artisan serve
```

**Terminal 2 - Compilador de assets (Vite):**

```bash
npm run dev
```

### 9. Acceder a la aplicación

Abre tu navegador y visita: [http://localhost:8000](http://localhost:8000)

## 👥 Tipos de Usuario

### Admin

-   Email: `admin@admin.com`
-   Password: `admin123`
-   Acceso completo al sistema

### Empresa

-   Puede crear y gestionar cupones
-   Gestiona su perfil de empresa

### Cliente

-   Puede comprar y usar cupones
-   Gestiona su perfil personal

## 🛠️ Comandos Útiles

### Limpiar caché

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Recrear base de datos

```bash
php artisan migrate:fresh --seed
```

### Compilar assets para producción

```bash
npm run build
```

### Ejecutar tests

```bash
php artisan test
```

## 📁 Estructura del Proyecto

```
cuponera_LIS_fase1/
├── app/                    # Lógica de la aplicación
│   ├── Http/
│   │   └── Controllers/    # Controladores
│   └── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── seeders/            # Seeders
├── resources/
│   ├── css/                # Estilos Tailwind
│   ├── js/                 # JavaScript y Alpine.js
│   └── views/              # Vistas Blade
├── routes/
│   ├── web.php             # Rutas web
│   └── auth.php            # Rutas de autenticación
└── public/                 # Archivos públicos
```

## 🎨 Tecnologías

-   **Backend**: Laravel 12.x
-   **Frontend**: Blade, Tailwind CSS, Alpine.js
-   **Base de Datos**: MySQL (XAMPP)
-   **Autenticación**: Laravel Breeze
-   **Roles y Permisos**: Spatie Permission
-   **Build Tool**: Vite 5.4.20

## 🔐 Seguridad

Si encuentras alguna vulnerabilidad de seguridad, por favor contacta al equipo de desarrollo.

## 📝 Licencia

Este proyecto es parte de un trabajo académico para LIS - Universidad Don Bosco

## 👨‍💻 Desarrollo

### Crear nuevo controlador

```bash
php artisan make:controller NombreController
```

### Crear nuevo modelo con migración

```bash
php artisan make:model Nombre -m
```

### Crear nuevo seeder

```bash
php artisan make:seeder NombreSeeder
```

### Ver rutas disponibles

```bash
php artisan route:list
```

## 🐛 Solución de Problemas

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error con permisos en storage/

```bash
# Windows
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Error con Vite

```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

### Puerto 8000 ya está en uso

```bash
php artisan serve --port=8080
```

## 📞 Soporte

Para preguntas o problemas, contacta al equipo de desarrollo o abre un issue en el repositorio.
