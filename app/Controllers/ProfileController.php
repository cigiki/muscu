<?php namespace App\Controllers;

use App\Models\Personne;
use CodeIgniter\Controller;

class ProfileController extends BaseController
{
    
    public function index()
    {
        helper(['url']);

        $session = session();



        // Récupérer tous les utilisateurs
        $personnes = new Personne();
        $utilisateurs = $personnes->where('type', 'utilisateur')->get();


        // Passer les données à la vue
        $data = [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'utilisateurs' => $utilisateurs
        ];

        echo view('profileuti', $data);
    }
}
