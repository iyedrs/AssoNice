<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='Inscription';
    //nom de la clé primaire si différente de id
    protected $primaryKey='ins_id';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    //liste des champs modifiables
    protected $fillable=[
        'ins_id',
        'ins_date',
        'ins_etat',
        'adh_id',
        'com_id'
    ];

    function adherent(){
        return $this->belongsTo(Adherent::class,'adh_id','adh_id');
    }

    function competition(){
        return $this->belongsTo(Competition::class,'com_id','com_id');
    }
}
  