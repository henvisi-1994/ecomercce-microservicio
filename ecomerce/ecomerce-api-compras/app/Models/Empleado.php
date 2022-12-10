<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'id_empresa',
        'id_usu',
        'id_cargo',
        'id_persona',
        'estado_empl',
    ];
    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo', 'id_cargo','id_cargo');
    }
}
