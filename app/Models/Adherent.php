<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Adherent extends Model
{
     
    //nom de la table dans la base de données    
    protected $table='ADHERENT';
    //nom de la clé primaire si différente de id
    protected $primaryKey='ADH_ID';
    public $timestamps = false;
    
    protected $fillable=[
        'CLU_ID',
        'DIS_ID',
        'ADH_NOM',
        'ADH_PRENOM',
        'ADH_DDN',
        'ADH_ADRESSE',
        'ADH_HASH_PWD',
        'ADH_EMAIL',
    ];

    function club(){
        return $this->belongsTo(Club::class,'CLU_ID','CLU_ID');
    }

    function discipline(){
        return $this->belongsTo(Discipline::class,'DIS_ID','DIS_ID');
    }

    function inscription(){
        return $this->hasMany(Inscription::class,'ADH_ID','ADH_ID');
    }

    function roles(){
        return $this->belongsToMany(Role::class, 'ADHERENT_ROLE', 'ADH_ID', 'ROL_ID');
    }

    function maxRole(): int
    {
        return $this->roles->max('ROL_ID') ?? 0;
    }

    function hasRole(int $roleId): bool
    {
        return $this->roles->contains('ROL_ID', $roleId);
    }
}
  