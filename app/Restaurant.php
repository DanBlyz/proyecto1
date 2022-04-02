<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    
    protected $table = 'restaurantes';

    protected $fillable = [
        'admin_id',
        'gerente_id',
        'nombre',
        'tipo',
        'logotipo',
        'objetivo',
        'hora_apertura',
        'hora_cierre',
        'validacion',
        'fecha_inicio',
        'direccion',
        'ubicacion',
        'deleted_at'
    ];
}
