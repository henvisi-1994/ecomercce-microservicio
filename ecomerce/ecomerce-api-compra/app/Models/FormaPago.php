<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'forma_pago';
    protected $primaryKey = 'id_formapago';
    protected $fillable = [
        'nomb_formapago',
        'observ_formapago',
        'estado_formapago'
    ];
}
