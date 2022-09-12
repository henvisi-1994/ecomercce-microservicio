<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'persona';
    protected $primaryKey = 'id_persona';
    protected $fillable = [
       'nombre_persona',
       'apellido_persona',
       'dni',
       'id_tipo_ident'
    ];
}
