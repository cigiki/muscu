<?php
namespace App\Controllers;

use App\Models\Personne;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;

class ApiConnexionController extends BaseController
{
    public function login()
    {
        helper(['url']);

        // Récupérer POST
        $identifiant = $this->request->getPost('identifiant');
        $mdp = $this->request->getPost('mdp');

        $user = Personne::where('identifiant', $identifiant)->first();

        header('Content-Type: application/json'); // Réponse JSON pour Android

        if ($user && password_verify($mdp, $user->mdp)) {

            // Générer JWT
            $key = getenv('JWT_SECRET');  // ⭐ Récupère la clé depuis .env
            
            // ⭐ CORRECTION : Utilisez $key au lieu de $secretKey
            $payload = [
                "id" => $user->id,
                "nom" => $user->nom,
                "prenom" => $user->prenom,
                "identifiant" => $user->identifiant,
                "type" => $user->type,
                "iat" => time(),
                "exp" => time() + 3600 // 1h de validité
            ];
 
            $jwt = JWT::encode($payload, $key, 'HS256');  // ⭐ $key au lieu de $secretKey
            echo json_encode(['token' => $jwt, 'user_id' => $user->id]);
            return;
        }

        // Identifiant ou mot de passe incorrect
        http_response_code(401);
        echo json_encode(['error' => 'Identifiant ou mot de passe incorrect']);
    }
}