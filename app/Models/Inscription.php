<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='INSCRIPTION';
    //nom de la clé primaire si différente de id
    protected $primaryKey='INS_ID';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    //liste des champs modifiables
    protected $fillable=[
        'INS_ID',
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
  