<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $fillable = [
       'tipo_cli',
       'fecha_inicio',
       'fecha_fin',
       'id_persona',
       'id_empresa',
       'id_direccion',
       'id_usu'
    ];
}
