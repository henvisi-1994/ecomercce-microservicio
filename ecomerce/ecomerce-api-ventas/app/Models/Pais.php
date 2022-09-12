<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'pais';
    protected $primaryKey = 'id_pais';
    protected $fillable = [
        'nombre_pais','estado_pais'
    ];
}
