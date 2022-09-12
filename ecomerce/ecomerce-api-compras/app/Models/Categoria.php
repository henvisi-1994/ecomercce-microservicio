<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'categoria';
    protected $primaryKey = 'id_cat';
    protected $fillable = [
       'nomb_cat',
       'observ_cat',
       'estado_cat'
    ];
}
