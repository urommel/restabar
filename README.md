# Sistema de Gestión de Pedidos

## Descripción
Este es un sistema de gestión de pedidos desarrollado con Laravel 12 y Alpine.js. Diseñado para restaurantes, bares o cafeterías, permite a los empleados tomar pedidos, administrarlos en cocina y gestionar mesas de manera eficiente.

## Tecnologías utilizadas
- **Backend**: Laravel 12
- **Frontend**: Alpine.js, Tailwind CSS
- **Base de datos**: MySQL
- **Autenticación**: Laravel Breeze

## Características principales

### Sistema de roles
- **Personal de atención (Frontline)**: Tomar pedidos y gestionar mesas
- **Personal de cocina (Kitchen)**: Ver pedidos pendientes y actualizar su estado

### Funcionalidades
- Gestión de pedidos en tiempo real
- Asignación de pedidos a mesas específicas
- Sistema de actualización de estado de pedidos
- Panel de control para diferentes roles
- Interfaz receptiva para dispositivos móviles y escritorio

## Requisitos previos
- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o PostgreSQL
- Git

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/urommel/restabar.git
   cd restabar
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript**
   ```bash
   npm install
   ```

4. **Configurar el entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**
    - Editar el archivo `.env` con las credenciales de tu base de datos

6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Compilar assets**
   ```bash
   npm run build
   ```

8. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

## Uso del sistema

### Acceso
- Usuarios predefinidos por roles están disponibles a través de los seeders
- Credenciales de prueba:
    - Frontline: susan@example.com / 123456
    - Kitchen: johnn@example.com / 123456

### Flujo de trabajo
1. **Personal de atención**:
    - Inicia sesión y selecciona "Tomar pedidos"
    - Selecciona una mesa
    - Agrega productos al pedido
    - Confirma el pedido

2. **Personal de cocina**:
    - Inicia sesión y accede a "Atender pedidos"
    - Visualiza pedidos pendientes
    - Actualiza el estado de los pedidos (en preparación, completado)

## Estructura del proyecto
El proyecto sigue la estructura estándar de Laravel con algunas carpetas específicas:
- `app/Enums`: Enumeraciones para roles y estados
- `app/Models`: Modelos de datos (Pedidos, Productos, etc.)
- `app/Http/Controllers`: Controladores separados por funcionalidad


