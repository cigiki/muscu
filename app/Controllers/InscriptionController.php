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

        $validationRules = [
            'nom' => 'required',
            'prenom' => 'required',
            'identifiant' => 'required|is_unique[personnes.identifiant]',
            'mdp' => 'required|min_length[4]',
        ];

        if (!$this->validate($validationRules)) {
            return view('inscription', ['validation' => $this->validator]);
        }

        $personne = new Personne();
        $personne->id = $this->request->getPost('id');
        $personne->nom = $this->request->getPost('nom');
        $personne->prenom = $this->request->getPost('prenom');
        $personne->identifiant = $this->request->getPost('identifiant');
        $personne->mdp = password_hash($this->request->getPost('mdp'), PASSWORD_DEFAULT);
        $codeSaisi = $this->request->getPost('code_coach');
        $codeCorrect = "coach2024"; // code secret connu seulement entre coachs

        $role = ($codeSaisi === $codeCorrect) ? 'coach' : 'utilisateur';

        $personne->type = $role;

        $personne->save();

        return redirect()->to('/connexion');
    }
}
