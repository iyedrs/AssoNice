<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
     
    //nom de la table dans la base de données si   
    //différente de ouvrages
    protected $table='COMPETITION';
    //nom de la clé primaire si différente de id
    protected $primaryKey='COM_ID';
    public $timestamps = false;
    
    protected $fillable=[
        'COM_NOM',
        'COM_DATE',
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
        return $this->hasMany(Inscription::class,'COM_ID','COM_ID');
    }
}
  