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
    public $timestamps = false;
    
    protected $fillable=[
        'CLU_NOM',
        'CLU_ADRESSEVILLE',
        'CLU_ADRESSERUE',
        'CLU_ADRESSECP',
        'CLU_MAIL',
        'CLU_TELFIXE'
    ];

    function disciplines(){
        return $this->belongsToMany(Discipline::class,'CLUB_DISCIPLINE','CLUB_ID','DISCIPLINE_ID');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'CLU_ID','CLU_ID');
    }

    function competition(){
        return $this->hasMany(Competition::class,'CLU_ID','CLU_ID');
    }
}
  