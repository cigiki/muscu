<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    public $timestamps=false;
    protected $fillable = ['utilisateur_id','type']; 

}
