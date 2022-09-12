<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioPedido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_envio';
    protected $fillable = [
       'fecha_inicio_ped',
       'fecha_fin_ped',
       'fecha_registro_env',
       'ciudad_origen',
       'ciudad_destino',
       'id_pedido'
    ];
}
