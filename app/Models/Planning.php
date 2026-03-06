<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Planification;
class Planning extends Model
{
    protected $table = 'plannings';
    public $timestamps = false;
    protected $fillable = ['utilisateur_id']; // champs qu’on peut remplir
   
    //retourne LES planifications associées au planning
    public function planifications()
    {
      return $this->hasMany(Planification::class);
    }
}
