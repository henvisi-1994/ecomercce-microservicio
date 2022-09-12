<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;
    protected $table = 'tipo_identificacion';
    protected $primaryKey = 'id_tipo_ident	';
    protected $fillable = [
       'nombre_tipo_ident',
       'estado_tipo_ident',
    ];
}
