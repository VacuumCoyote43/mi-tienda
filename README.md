# MI TIENDA - Tutorial Paso a Paso

## Requisitos Previos

1. **Instalar Software Necesario**:
   - PHP 8.1 o superior
   - Composer (gestor de dependencias de PHP)
   - MySQL
   - Node.js y npm

## Paso 1: Crear el Proyecto

1. **Crear nuevo proyecto Laravel**:
   ```bash
   composer create-project laravel/laravel mi-tienda
   cd mi-tienda
   ```

2. **Instalar dependencias de frontend**:
   ```bash
   npm install
   ```

## Paso 2: Configuración Inicial

1. **Configurar base de datos**:
   - Crear base de datos MySQL
   - Configurar archivo `.env` con los datos de conexión

2. **Instalar autenticación**:
   ```bash
   composer require laravel/ui
   php artisan ui bootstrap --auth
   npm install && npm run dev
   ```

## Paso 3: Crear Estructura de Base de Datos

1. **Crear migraciones**:
   ```bash
   php artisan make:migration add_role_to_users_table
   php artisan make:migration create_categories_table
   php artisan make:migration create_products_table
   php artisan make:migration create_characteristics_table
   php artisan make:migration create_characteristic_product_table
   php artisan make:migration create_carts_table
   php artisan make:migration create_orders_table
   php artisan make:migration create_order_lines_table
   ```

2. **Definir estructura de tablas** en cada migración:
   - Users: añadir campo role
   - Categories: id, name, description
   - Products: id, name, description, price, image, category_id
   - Characteristics: id, name
   - Characteristic_product: product_id, characteristic_id
   - Carts: id, user_id, product_id, quantity
   - Orders: id, user_id, total, status
   - Order_lines: id, order_id, product_id, quantity, price

## Paso 4: Crear Modelos y Relaciones

1. **Crear modelos**:
   ```bash
   php artisan make:model Category
   php artisan make:model Product
   php artisan make:model Characteristic
   php artisan make:model Cart
   php artisan make:model Order
   php artisan make:model OrderLine
   ```

2. **Definir relaciones** en cada modelo (hasMany, belongsTo, etc.)

## Paso 5: Crear Controladores

1. **Crear controladores**:
   ```bash
   php artisan make:controller Admin/CategoryController --resource
   php artisan make:controller Admin/ProductController --resource
   php artisan make:controller Admin/CharacteristicController --resource
   php artisan make:controller Admin/OrderController
   php artisan make:controller Shop/HomeController
   php artisan make:controller Shop/CartController
   php artisan make:controller Shop/OrderController
   ```

## Paso 6: Crear Vistas

1. **Estructura de carpetas**:
   ```
   resources/views/
   ├── layouts/
   │   └── app.blade.php
   ├── modules/
   │   ├── category/
   │   ├── characteristic/
   │   ├── home/
   │   ├── orders/
   │   └── product/
   └── shop/
       ├── cart/
       ├── home.blade.php
       └── orders/
   ```

2. **Crear vistas** para cada sección usando Bootstrap

## Paso 7: Configurar Rutas

1. **Definir rutas** en `routes/web.php`:
   - Rutas públicas
   - Rutas protegidas por autenticación
   - Rutas de administración

## Paso 8: Crear Seeders

1. **Crear y configurar seeders**:
   ```bash
   php artisan make:seeder UserSeeder
   php artisan make:seeder CategorySeeder
   php artisan make:seeder CharacteristicSeeder
   php artisan make:seeder ProductSeeder
   ```

## Paso 9: Implementar Funcionalidades

1. **Panel de Administración**:
   - CRUD de categorías
   - CRUD de productos
   - CRUD de características
   - Gestión de pedidos

2. **Tienda**:
   - Listado de productos
   - Carrito de compras
   - Proceso de compra
   - Historial de pedidos

## Paso 10: Ejecutar el Proyecto

1. **Preparar base de datos**:
   ```bash
   php artisan migrate:fresh --seed
   ```

2. **Iniciar servidor**:
   ```bash
   php artisan serve
   npm run dev
   ```

3. **Acceder a la aplicación**:
   - URL: `http://localhost:8000`
   - Admin: `admin@mitienda.com` / `password`
   - Usuario: `user@mitienda.com` / `password`

## Características Implementadas

1. **Autenticación y Autorización**:
   - Registro y login de usuarios
   - Roles (admin/customer)
   - Middleware de protección

2. **Catálogo**:
   - Categorías de productos
   - Productos con imágenes
   - Características de productos
   - Buscador y filtros

3. **Carrito de Compras**:
   - Añadir/quitar productos
   - Actualizar cantidades
   - Persistencia del carrito

4. **Gestión de Pedidos**:
   - Crear pedidos
   - Ver historial
   - Estados de pedido
   - Panel de administración

## Consejos de Desarrollo

1. **Buenas Prácticas**:
   - Usar nombres descriptivos
   - Mantener código limpio y documentado
   - Seguir convenciones de Laravel
   - Validar entradas de usuario

2. **Seguridad**:
   - Proteger rutas sensibles
   - Validar permisos
   - Sanitizar datos
   - Usar CSRF protection

3. **Mantenimiento**:
   - Hacer commits frecuentes
   - Mantener dependencias actualizadas
   - Hacer copias de seguridad
   - Monitorear errores
