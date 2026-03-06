<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planification extends Model
{
    public $timestamps=false;

    public function exercice(){
        return $this->belongsTo('\App\Models\Exercice','exercice_id');
    }
}
