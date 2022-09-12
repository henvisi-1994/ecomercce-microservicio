<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'estado_pedido';
    protected $primaryKey = 'id_estado_pedido';
    protected $fillable = [
        'estado_inicial',
        'estado_actual',
        'estado_final',
        'fecha_registro',
        'id_pedido'
    ];
}
