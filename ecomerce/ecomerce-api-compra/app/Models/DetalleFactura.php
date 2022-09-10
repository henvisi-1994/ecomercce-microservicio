<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'detalle_factura';
    protected $primaryKey = 'id_detalle_fact';
    protected $fillable = [
       'id_fact',
       'id_prod',
       'cantidad',
       'descripcion',
       'precio_prod',
       'descuento',
       'neto',
       'iva',
       'total'
    ];
}
