<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='Discipline';
    //nom de la clé primaire si différente de id
    protected $primaryKey='dis_id';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    //liste des champs modifiables
    protected $fillable=[
        'dis_id',
        'dis_nom'
    ];

    function club(){
        return $this->hasMany(Club::class,'dis_id','dis_id');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'dis_id','dis_id');
    }

    function competition(){
        return $this->hasMany(Competition::class,'dis_id','dis_id');
    }
}
  