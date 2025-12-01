# La Cuponera SV

Sistema de gestión de cupones donde empresas venden ofertas y clientes obtienen descuentos.

## ⚡ Instalación Rápida

### Requisitos

-   XAMPP (PHP 8.2+)
-   Composer
-   Node.js 20+

### Pasos

```bash
# 1. Clonar e instalar
git clone https://github.com/eduardoezequieel/cuponera_LIS_2025.git
cd cuponera_LIS_2025
composer install
npm install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Crear base de datos 'cuponera' en phpMyAdmin (XAMPP)

# 4. Configurar .env
DB_DATABASE=cuponera
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrar y poblar base de datos
php artisan migrate:fresh --seed

# 6. Iniciar servidor (2 terminales)
php artisan serve          # Terminal 1
npm run dev                # Terminal 2
```

Accede: **http://localhost:8000**

## 🔑 Credenciales

**Admin:** `admin@admin.com` / `admin123`  
**Empresas:** `[email]` / `password123`  
**Clientes:** `[email]` / `password123`

## 📊 Datos de Prueba

-   15 empresas (Pizza Hut, Burger King, Cinépolis, etc.)
-   53 cupones activos
-   20 clientes
-   158+ compras realizadas

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

## 🎨 Stack Tecnológico

-   Laravel 12 + Breeze
-   MySQL (XAMPP)
-   Tailwind CSS + Alpine.js
-   Spatie Permission
-   DomPDF (reportes)
-   Vite

## ⚠️ Problemas Comunes

**Error encryption key:** `php artisan key:generate`  
**Puerto ocupado:** `php artisan serve --port=8080`  
**Error Vite:** `npm cache clean --force && npm install`

## 👥 Autores

Este proyecto fue realizado por:

-   **Christian Gustavo Crespin Lozano** - CL060107
-   **Diego Guillermo Esnard Romero** - ER231474
-   **Diego Rene López Martinez** - LM231893
-   **Eduardo Ezequiel López Rivera** - LR230061

## 📝 Licencia

Proyecto académico - LIS Universidad Don Bosco
