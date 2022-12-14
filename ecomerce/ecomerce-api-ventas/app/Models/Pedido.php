<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido';
    protected $fillable = [
        'total',
        'fecha_inicio',
        'fecha_ult_mod',
        'fecha_registro_ped',
        'estado_ped',
        'id_cliente',
        'id_formapago'
    ];
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id_cliente','id_cliente');
    }
    public function formapago()
    {
        return $this->hasOne('App\Models\FormaPago', 'id_formapago','id_formapago');
    }
}
