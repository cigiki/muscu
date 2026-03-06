<?php

namespace App\Controllers;

use App\Models\Planning;       // Modèle Planning pour accéder aux plannings des utilisateurs
use App\Models\Planification;  // Modèle Planification pour accéder aux exercices planifiés
use App\Models\Exercice;       // Modèle Exercice pour récupérer les informations des exercices

class PlanningServiceController extends BaseController
{
    // Fonction pour récupérer tous les exercices de la semaine pour un utilisateur
    public function getPlanningSemaine()
    {
        // Récupère l'ID de l'utilisateur passé dans l'URL en GET
        $user_id = $this->request->getGet('user_id');

        // Récupérer le planning de l'utilisateur à partir de son ID
        $planning = Planning::where('utilisateur_id', $user_id)->first();

        // Vérifie si un planning existe
        // Si oui, on prend l'ID du planning, sinon on met 0 pour éviter les erreurs
        if ($planning) {
            $idpla = $planning->id;
        } else {
            $idpla = 0;
        }

        // Récupère toutes les planifications (exercices planifiés) pour ce planning
        $planifications = Planification::where('planning_id', $idpla)->get();

        // Initialise un tableau pour stocker les informations des exercices
        $exercices = [];
        foreach ($planifications as $p) {
            // Récupère les détails de l'exercice correspondant à chaque planification
            $exo = Exercice::find($p->exercice_id);
            if ($exo) {
                // Ajoute les informations de l'exercice au tableau
                $exercices[] = [
                    'jour' => $p->numJour,           // Le jour auquel l'exercice est prévu
                    'exercice_id' => $exo->id,       // L'ID de l'exercice
                    'nom_exercice' => $exo->nom      // Le nom de l'exercice
                ];
            }
        }

        // Retourne le résultat en JSON, comme dans le style du prof
        return $this->response->setJSON([
            'success' => true,           // Indique que l'opération a réussi
            'user_id' => $user_id,       // ID de l'utilisateur concerné
            'planning' => $exercices     // Tableau contenant tous les exercices planifiés
        ]);
    }
}
//http://localhost/~resul.karatas/muscu/public/index.php/service/planning-semaine?user_id=2