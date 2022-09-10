<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'producto';
    protected $primaryKey = 'id_prod';
    protected $fillable = [
        'codigo_prod',
        'codbarra_prod',
        'descripcion_prod',
        'present_prod',
        'precio_prod',
        'stockmin_prod',
        'stockmax_prod',
        'stock_prod',
        'fechaing_prod',
        'fechaelab_prod',
        'fechacad_prod',
        'aplicaiva_prod',
        'aplicaice_prod',
        'util_prod',
        'comision_prod',
        'imagen_prod',
        'observ_prod',
        'estado_prod',
        'id_bod',
        'id_marca',
        'id_cat',
        'id_empresa'
    ];
}
