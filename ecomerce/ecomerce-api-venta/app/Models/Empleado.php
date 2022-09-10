<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'id_empresa',
        'id_usu',
        'id_cargo',
        'id_persona',
        'estado_empl',
    ];
}
