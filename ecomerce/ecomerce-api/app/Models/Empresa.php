<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'empresa';
    protected $primaryKey = 'id_empresa';
    protected $fillable = [
       'razon_social',
       'codigo_envio',
       'nombre_comercial',
       'ruc',
       'fecha_inicio',
       'fecha_fin',
       'estado_empresa'
    ];
}
