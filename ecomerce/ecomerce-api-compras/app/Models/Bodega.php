<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'bodega';
    protected $primaryKey = 'id_bod';
    protected $fillable = [
        'nombre_bod',
        'estado_bod',
        'telef_bod',
        'cel_bod',
        'nomb_contac_bod',
        'fecha_inicio',
        'fecha_fin',
        'id_ciudad',
        'id_direccion',
    ];
}
