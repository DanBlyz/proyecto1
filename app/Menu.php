<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    protected $table = 'menus';

    protected $fillable = [
        'restaurant_id',
        'tipo',
        'deleted_at'
    ];
}
