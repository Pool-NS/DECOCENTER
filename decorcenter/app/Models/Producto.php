<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // ✅ Aquí defines los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        // Agrega cualquier otro campo necesario
    ];
}
