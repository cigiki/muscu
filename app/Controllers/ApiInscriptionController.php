<?php namespace App\Controllers;

use App\Models\Personne;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;

class ApiInscriptionController extends BaseController
{
    public function register()
    {
        helper(['url']);

        // Récupération des données POST
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $identifiant = $this->request->getPost('identifiant');
        $mdp = $this->request->getPost('mdp');

        header('Content-Type: application/json');

        // Vérifier si utilisateur existe déjà
        $existingUser = Personne::where('identifiant', $identifiant)->first();

        if ($existingUser) {
            http_response_code(400);
            echo json_encode([
                'error' => 'Identifiant déjà utilisé'
            ]);
            return;
        }

        // Hash du mot de passe
        $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);

        // Création utilisateur
        $user = new Personne();
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->identifiant = $identifiant;
        $user->type = 'utilisateur';
        $user->mdp = $hashedPassword;
        $user->save();

        // Génération du JWT (comme login)
        $secretKey = "ma_super_cle_secrete_pour_mon_application_muscu_2025";

        $payload = [
            "id" => $user->id,
            "nom" => $user->nom,
            "prenom" => $user->prenom,
            "identifiant" => $user->identifiant,
            "type" => 'utilisateur',
            "iat" => time(),
            "exp" => time() + 3600
        ]; 

        $jwt = JWT::encode($payload, $secretKey, 'HS256');

        echo json_encode([
            'token' => $jwt
        ]);
    }
}