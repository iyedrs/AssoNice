<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='Club';
    //nom de la clé primaire si différente de id
    protected $primaryKey='chu_id';
    //pour ne pas utiliser les champs date création et modification
    public $timestamps = false;
    //si la clé n'est pas en auto incrément
    public $incrementing = false;
    //si la clé n'est pas de type integer
    protected $keyType= 'string';
    
    

    //liste des champs modifiables
    protected $fillable=[
        'clu_id',
        'clu_nom',
        'clu_adresseVille',
        'clu_adresseRue',
        'clu_adresseCP',
        'clu_mail',
        'clu_telFixe',
        'dis_id'
    ];

    function discipline(){
        return $this->belongsTo(Discipline::class,'dis_id','dis_id');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'clu_id','clu_id');
    }

    function competition(){
        return $this->hasMany(Competition::class,'clu_id','clu_id');
    }
}
  