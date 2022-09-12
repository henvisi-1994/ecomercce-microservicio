<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;
    protected $table = 'detalle_producto';
    protected $primaryKey = 'id_detalle_prod';
}
