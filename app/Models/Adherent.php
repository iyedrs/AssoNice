<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
     
    //nom de la table dans la base de données    
    protected $table='ADHERENT';
    //nom de la clé primaire si différente de id
    protected $primaryKey='ADH_ID';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    

    //liste des champs modifiables
    protected $fillable=[
        'ADH_ID',
        'CLU_ID',
        'DIS_ID',
        'ADH_NOM',
        'ADH_PRENOM',
        'ADH_DDN',
        'ADH_ADRESSE',
        'ADH_HASH_PWD',
        'ADH_EMAIL',
        'ADH_ROLE',
        'CLU_ID',
        'DIS_ID'
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
}
  