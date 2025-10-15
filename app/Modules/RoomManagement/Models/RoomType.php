<?php

namespace App\Modules\RoomManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';

    protected $fillable = ['name', 'description', 'base_price', 'capacity'];
}

/**
 * RoomType
 *
 * Modelo Eloquent que representa un tipo de habitación (por ejemplo "Tika Simple").
 * Campos principales:
 * - name: nombre del tipo
 * - description: texto descriptivo
 * - base_price: precio base por noche
 * - capacity: número máximo de huéspedes
 *
 * Uso:
 * - Se utiliza para agrupar atributos comunes de habitaciones físicas.
 * - Los servicios y controladores referencian esto para calcular precios y mostrar información.
 */

// Nota: No hay lógica adicional en este modelo por ahora. Si se necesita lógica
// business-specific (por ejemplo, tarifas por temporada), crear un Service
// en `app/Modules/RoomManagement/Services` para encapsularla.
