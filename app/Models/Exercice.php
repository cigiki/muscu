<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    public $timestamps=false;
    public function planifications(){
        return $this->hasMany('\App\Models\planification');
    }

}