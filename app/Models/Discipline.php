<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $table='DISCIPLINE';
    protected $primaryKey='DIS_ID';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType= 'string';
    
    protected $fillable=[
        'DIS_ID',
        'DIS_NOM'
    ];

    function club(){
        return $this->hasMany(Club::class,'DIS_ID','DIS_ID');
    }

    function adherent(){
        return $this->hasMany(Adherent::class,'DIS_ID','DIS_ID');
    }

    function competition(){
        return $this->hasMany(Competition::class,'DIS_ID','DIS_ID');
    }
}
  