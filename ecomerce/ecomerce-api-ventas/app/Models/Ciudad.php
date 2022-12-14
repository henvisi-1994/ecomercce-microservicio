<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'ciudad';
    protected $primaryKey = 'id_ciudad';
    protected $fillable = [
       'nombre_ciudad',
       'id_provincia',
       'estado_ciudad'
    ];
    public function provincia()
    {
        return $this->hasOne(Provincia::class, 'id_provincia');
    }
}
