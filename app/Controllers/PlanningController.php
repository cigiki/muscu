<?php namespace App\Controllers;

use App\Models\Planning;
use App\Models\Exercice;
use App\Models\Planification;
use CodeIgniter\Controller;

class PlanningController extends BaseController
{
    public function index()
    {
        helper(['url', 'form']);
        $uid=$this->request->getVar('user_id');
        $data=array();
        
        $planning=Planning::where('utilisateur_id',$uid)->first();
        if ($planning!=null){
            $planifications = $planning->planifications()->get();
            $data["planifications"]=$planifications;
            //var_dump($planifications);die();
            /*$nbplanif=count($planifications);
            echo("nbplanif:".$nbplanif);die();*/
        }else{
            /*echo "POURQUOI!!!???";die();*/
            $data["planifications"]=array();
        }
        
        $data["user_id"]=$uid;  
    
        
        echo view('planning', $data); 
    }

    public function sauvegarder()
    {
        $user_id = $this->request->getPost('user_id');

        $session=session();


        //je regarde si un planning existe
        $planning=Planning::where('utilisateur_id',$user_id)->first();

        //si j'en ai un je le modifie sinon je le cree
        if ($planning === null) {
            $planning = new Planning();
            $planning->utilisateur_id=$user_id;
            $planning->coach_id=$session->get("id");
             
        }else{
            //je fais le menage //a debugger
            $planning->planifications()->delete();
        }
        $planning->save();
        
        //on recupere les donnees postees lors du submit
        $tabJours=$this->request->getPost('jours');
        $tabNomExo=$this->request->getPost('nomExo');
        
        //pour chaque exercice positionné on sauve une entree dans la table d'association
        //recup taille des deux tableaux
        $taille=count($tabJours);
        //on parcoure simultanément les deux tableaux pour associer un jour a un exercice
        for ($i=0 ;$i<$taille; $i++){
            $numjour=$tabJours[$i];
            $nomexo=$tabNomExo[$i];
            //recuperer l'exo
            $exo=Exercice::where('nom',$nomexo)->first();
            $planif=new Planification();
            $planif->exercice_id=$exo->id;
            $planif->planning_id=$planning->id;    
            $planif->numjour=$numjour;
            $planif->save();

            

        }

        return redirect()->to('/planning?user_id='.$user_id)->with('message', 'Planning sauvegardé !');
    }
}
