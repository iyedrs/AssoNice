<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='DISCIPLINE';
    //nom de la clé primaire si différente de id
    protected $primaryKey='DIS_ID';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    //liste des champs modifiables
    protected $fillable=[
        'DIS_ID',
        'DIS_NOM'
    ];

    function club(){
        return $this->hasMany(Club::class,'DIS_ID','DIS_ID');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'DIS_ID','DIS_ID');
    }

    function competition(){
        return $this->hasMany(Competition::class,'DIS_ID','DIS_ID');
    }
}
  