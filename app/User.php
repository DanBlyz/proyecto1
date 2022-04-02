<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id',
        'name', 
        'email', 
        'password',
        'fecha_nacimiento',
        'direccion',
        'nickname',
        'pais',
        'telefono',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function sector()
    // {
    //     return $this->belongsTo('App\Sector', 'sector_id');
    // }

    // public function perfil()
    // {
    //     return $this->belongsTo('App\Perfil', 'perfil_id');
    // }

    public function categorias()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }

}
