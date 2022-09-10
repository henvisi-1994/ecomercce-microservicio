<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'detalle_pedido';
    protected $primaryKey = 'id_detalle_ped';
    protected $fillable = [
       'id_prod',
       'id_pedido',
       'cantidad',
       'total_detalle'
    ];
}
