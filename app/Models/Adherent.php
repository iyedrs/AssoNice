<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
     
    //nom de la table dans la base de données    
    protected $table='Adherent';
    //nom de la clé primaire si différente de id
    protected $primaryKey='adh_id';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    

    //liste des champs modifiables
    protected $fillable=[
        'adh_id',
        'clu_id',
        'dis_id',
        'adh_nom',
        'adh_prenom',
        'adh_ddn',
        'adh_adresse',
        'clu_id',
        'dis_id'
    ];

    function club(){
        return $this->belongsTo(Club::class,'clu_id','clu_id');
    }

    function discipline(){
        return $this->belongsTo(Discipline::class,'dis_id','dis_id');
    }

    function inscription(){
        return $this->hasMany(Inscription::class,'adh_id','adh_id');
    }
}
  