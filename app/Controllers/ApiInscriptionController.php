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

        // -------------------------------------------------------------
        // ⭐ NOUVEAU : Vérification de la qualité du mot de passe
        // -------------------------------------------------------------
        $erreurMdp = $this->verifierMotDePasse($mdp);
        
        if ($erreurMdp !== null) {
            http_response_code(400);
            echo json_encode([
                'error' => $erreurMdp
            ]);
            return;
        }

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
        
        // Génération du JWT
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
    
    // -------------------------------------------------------------
    // ⭐ NOUVELLE FONCTION : Vérifie les règles du mot de passe
    // -------------------------------------------------------------
    private function verifierMotDePasse($mdp)
    {
        // 8 caractères minimum
        if (strlen($mdp) < 8) {
            return "Le mot de passe doit contenir au moins 8 caractères";
        }
        
        // Au moins 1 chiffre
        if (!preg_match('/[0-9]/', $mdp)) {
            return "Le mot de passe doit contenir au moins 1 chiffre";
        }
        
        // Au moins 1 majuscule
        if (!preg_match('/[A-Z]/', $mdp)) {
            return "Le mot de passe doit contenir au moins 1 lettre majuscule";
        }
        
        // Au moins 1 caractère spécial
        if (!preg_match('/[^a-zA-Z0-9]/', $mdp)) {
            return "Le mot de passe doit contenir au moins 1 caractère spécial (@, #, $, !, etc.)";
        }
        
        return null;
    }
}