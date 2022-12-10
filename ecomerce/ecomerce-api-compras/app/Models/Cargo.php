<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'cargo';
    protected $primaryKey = 'id_cargo	';
    protected $fillable = [
       'id_emp',
       'nomb_cargo',
       'observ_cargo',
       'estado_cargo',
       'fecha_inicio',
       'fecha_fin'
    ];
}
