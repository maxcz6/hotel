<?php

namespace App\Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guests';

    protected $fillable = ['full_name', 'email', 'phone', 'document_type', 'document_number'];
}
