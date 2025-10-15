# Sumay Tika PMS - Documentación del Código

Este documento resume la arquitectura, los módulos y las responsabilidades principales del código añadido al proyecto.

## Objetivo
Crear la base de un Property Management System (PMS) para el hotel boutique "Sumay Tika". El código está organizado en módulos bajo `app/Modules` para facilitar extensiones.

## Estructura principal

- `app/Modules/RoomManagement` - Gestión de tipos de habitación y habitaciones físicas.
  - `Models/RoomType.php` - Modelo Eloquent para tipos de habitación (nombre, precio base, capacidad).
  - `Models/Room.php` - Modelo Eloquent para habitaciones físicas y relación con `RoomType`.
  - `Services/RoomStatusService.php` - Lógica para cambios seguros de estado de habitación.

- `app/Modules/Booking` - Gestión de reservas y huéspedes.
  - `Models/Guest.php` - Modelo de huésped.
  - `Models/Booking.php` - Modelo de reserva (fechas, total, estado).
  - `Services/BookingService.php` - Lógica para crear reservas: valida disponibilidad, crea/encuentra huésped, crea booking, actualiza estado de la habitación y dispara evento `BookingCreated`.
  - `Events/BookingCreated.php` - Evento disparado tras crear una reserva.

- `app/Http/Livewire` - Componentes Livewire (stubs) para UI del panel admin: `RoomTypeManager`, `RoomGrid`, `BookingCalendar`, `CreateBookingForm`, `DashboardStats`.

- `resources/views/livewire` - Vistas Blade de los stubs de Livewire.

- `database/migrations` - Migraciones para `room_types`, `rooms`, `guests`, `bookings`, `roles`, etc.

## Cómo empezar
1. Configura `.env` con tus credenciales de MySQL.
2. Ejecuta `composer install` y `npm install`.
3. Ejecuta `php artisan migrate` y `php artisan db:seed --class=Database\\Seeders\\RoleSeeder`.
4. Levanta servidor: `php artisan serve` y `npm run dev`.

## Notas de diseño y extensibilidad
- Cada módulo usa su propio namespace (`App\\Modules\\...`) para agrupar modelos, servicios y eventos.
- Services (por ejemplo `BookingService`, `RoomStatusService`) encapsulan la lógica de negocio y deben ser usados por controllers o Livewire components.
- Livewire componentes están inicializados como stubs; implementar la UI con Tailwind + Alpine + Livewire es el siguiente paso.

Si necesitas que documente archivos adicionales o que inserte comentarios más detallados en archivos concretos, dime cuáles y lo hago.
