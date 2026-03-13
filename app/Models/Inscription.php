<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='INSCRIPTION';
    //nom de la clé primaire si différente de id
    protected $primaryKey='INS_NUM';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    
    //liste des champs modifiables
    protected $fillable=[
        'INS_DATE',
        'INS_ETAT',
        'ADH_ID',
        'COM_ID'
    ];

    function adherent(){
        return $this->belongsTo(Adherent::class,'ADH_ID','ADH_ID');
    }

    function competition(){
        return $this->belongsTo(Competition::class,'COM_ID','COM_ID');
    }
}
  