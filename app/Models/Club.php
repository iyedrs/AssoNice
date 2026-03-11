<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='CLUB';
    //nom de la clé primaire si différente de id
    protected $primaryKey='CLU_ID';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    

    //liste des champs modifiables
    protected $fillable=[
        'CLU_ID',
        'CLU_NOM',
        'CLU_ADRESSEVILLE',
        'CLU_ADRESSERUE',
        'CLU_ADRESSECP',
        'CLU_MAIL',
        'CLU_TELFIXE',
        'DIS_ID'
    ];

    function discipline(){
        return $this->belongsTo(Discipline::class,'DIS_ID','DIS_ID');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'CLU_ID','CLU_ID');
    }

    function competition(){
        return $this->hasMany(Competition::class,'CLU_ID','CLU_ID');
    }
}
  