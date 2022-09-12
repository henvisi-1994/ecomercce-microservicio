<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direcion extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'direccion';
    protected $primaryKey = 'id_direccion';
    protected $fillable = [
        'direcion',
        'calle',
        'numero',
        'piso',
        'telefono',
        'movil',
        'id_ciudad'
    ];
}
