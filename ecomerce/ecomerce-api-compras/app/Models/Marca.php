<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';
    protected $fillable = [
        'nomb_marca',
        'observ_marca',
        'estado_marca'
    ];
}
