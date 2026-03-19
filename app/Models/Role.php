<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ROLE';
    protected $primaryKey = 'ROL_ID';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'ROL_ID',
        'ROL_LIBELLE',
    ];

    function adherents()
    {
        return $this->hasMany(Adherent::class, 'ADH_ROLE', 'ROL_ID');
    }
}
