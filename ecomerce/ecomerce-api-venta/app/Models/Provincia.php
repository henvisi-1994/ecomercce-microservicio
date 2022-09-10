<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'provincia';
    protected $primaryKey = 'id_provincia';
    protected $fillable = ['nombre_provincia', 'id_pais', 'estado_prov'];
}
