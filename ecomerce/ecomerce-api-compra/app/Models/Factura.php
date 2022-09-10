<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'factura';
    protected $primaryKey = 'id_fact';
    protected $fillable = [
       'num_fact',
       'fecha_emision_fact',
       'hora_emision_fact',
       'vencimiento_fact',
       'observ_fact',
       'subtotal_fact',
       'subcero_fact',
       'subiva_fact',
       'subice_fact',
       'total_fact',
       'id_formapago'
    ];
}
