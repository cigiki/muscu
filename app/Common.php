<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */
/* <?php

namespace App\Controllers;

use App\Models\Planning;
use App\Models\Planification;
use App\Models\Exercice;

class PlanningServiceController extends BaseController
{
    // récupère les exercices du jour pour un utilisateur
    public function getExercicesJour()
    {
        $uid = $this->request->getGet('user_id'); 
        $jour = date('N'); 
        $exercices = [];
    
        $planning = Planning::where('utilisateur_id', $uid)->first();
    
        if ($planning) {
            $planifications = Planification::where('planning_id', $planning->id)->get(); // tous les jours
    
            foreach ($planifications as $planif) {
                $exo = Exercice::find($planif->exercice_id);
                if ($exo) {
                    $exercices[] = [
                        'id' => $exo->id,
                        'nom' => $exo->nom,
                        'description' => $exo->description,
                        'muscles' => $exo->muscles,
                        'jour' => $planif->numJour
                    ];
                }
            }
        }
    
        return $this->response->setJSON([
            'success' => true,
            'user_id' => $uid,
            'jour_actuel' => $jour,
            'exercices' => $exercices
        ]);
    }
    
}
//http://localhost/~resul.karatas/muscu/public/service/exercices-jour?user_id=1//*/