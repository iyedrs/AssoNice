<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='Competition';
    //nom de la clé primaire si différente de id
    protected $primaryKey='com_id';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    //liste des champs modifiables
    protected $fillable=[
        'com_id',
        'com_nom',
        'com_date',
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
        return $this->hasMany(Inscription::class,'com_id','com_id');
    }
}
  