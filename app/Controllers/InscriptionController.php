<?php namespace App\Controllers;

use App\Models\Personne;
use CodeIgniter\Controller;

class InscriptionController extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('inscription');
    }

    public function traiteInscription()
    {
        helper(['form']);

        // -------------------------------------------------------------
        // ⭐ NOUVEAU : Récupération du mot de passe pour vérification
        // -------------------------------------------------------------
        $mdp = $this->request->getPost('mdp');
        
        // ⭐ NOUVEAU : Vérification de la qualité du mot de passe
        $erreurMdp = $this->verifierMotDePasse($mdp);
        
        if ($erreurMdp !== null) {
            // En cas d'erreur, on retourne au formulaire avec le message
            return view('inscription', ['erreurMdp' => $erreurMdp]);
        }
        // -------------------------------------------------------------

        $validationRules = [
            'nom' => 'required',
            'prenom' => 'required',
            'identifiant' => 'required|is_unique[personnes.identifiant]',
            'mdp' => 'required|min_length[4]',  // Tu peux garder ou enlever
        ];

        if (!$this->validate($validationRules)) {
            return view('inscription', ['validation' => $this->validator]);
        }

        $personne = new Personne();
        $personne->id = $this->request->getPost('id');
        $personne->nom = $this->request->getPost('nom');
        $personne->prenom = $this->request->getPost('prenom');
        $personne->identifiant = $this->request->getPost('identifiant');
        $personne->mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $codeSaisi = $this->request->getPost('code_coach');
        $codeCorrect = "coach2024";

        $role = ($codeSaisi === $codeCorrect) ? 'coach' : 'utilisateur';

        $personne->type = $role;

        $personne->save();

        return redirect()->to('/connexion');
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