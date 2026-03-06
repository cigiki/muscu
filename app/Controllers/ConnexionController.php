<?php namespace App\Controllers;

use App\Models\Personne;
use CodeIgniter\Controller;

class ConnexionController extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        echo view('connexion');
    }

    public function traiteConnexion()
{
    helper(['url']);
    $session = session();

    $identifiant = $this->request->getPost('identifiant');
    $mdp = $this->request->getPost('mdp');
    $code_coach = $this->request->getPost('code_coach'); // récupère le code coach

    $user = Personne::where('identifiant', $identifiant)->first();

    if ($user && $user->type === 'coach' && password_verify($mdp, $user->mdp)) {

        // Vérification du code coach
        if ($code_coach !== 'coach2024') { // remplace '1234' par ton vrai code
            $session->setFlashdata('msg', 'Code coach incorrect !');
            return redirect()->to('/connexion');
        }

        // Connexion réussie
        $session->set([
            'id' => $user->id,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'identifiant' => $user->identifiant,
            'isLoggedIn' => true,
            'type' => $user->type
        ]);

        return redirect()->to('/profileuti');
    }

    // Bloque tous les autres utilisateurs
    $session->setFlashdata('msg', 'Seuls les coachs peuvent se connecter.');
    return redirect()->to('/connexion');
}
}