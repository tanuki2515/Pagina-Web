# OtakuShop - Tienda Online Anime

Tienda online de productos otaku construida con Laravel 12 + Tailwind CSS + MySQL.

## Funcionalidades

- Catalogo de productos con filtros por categoria y busqueda
- Carrito de compras con checkout via WhatsApp
- Autenticacion de usuarios (registro/login)
- Panel de administracion (CRUD productos, categorias, usuarios)
- Dashboard con estadisticas
- Diseño responsive con tema oscuro

## Stack Tecnologico

- **Backend:** Laravel 12 (PHP 8.2)
- **Frontend:** Tailwind CSS + Blade + Alpine.js
- **Base de datos:** MySQL
- **Auth:** Laravel Breeze

## Instalacion

```bash
# Clonar repositorio
git clone https://github.com/tanuki2515/Pagina-Web.git
cd Pagina-Web

# Instalar dependencias
composer install
npm install && npm run build

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
# DB_DATABASE=otakushop
# DB_USERNAME=root
# DB_PASSWORD=

# Ejecutar migraciones y seeders
php artisan migrate --seed

# Iniciar servidor
php artisan serve
```

## Usuarios por defecto (seeders)

| Rol | Email | Password |
|-----|-------|----------|
| Admin | admin@otakushop.com | password |
| Cliente | cliente@otakushop.com | password |

## Estructura del proyecto

```
app/
├── Http/Controllers/
│   ├── Admin/          # Panel de administracion
│   ├── Auth/           # Autenticacion (Breeze)
│   ├── CartController  # Carrito de compras
│   ├── ShopController  # Tienda publica
│   └── ProfileController
├── Models/
│   ├── User.php
│   ├── Product.php
│   └── Category.php
resources/views/
├── admin/              # Vistas del panel admin
├── shop/               # Catalogo y detalle
├── cart/               # Carrito
├── auth/               # Login/Registro
└── layouts/            # Layouts base
```
