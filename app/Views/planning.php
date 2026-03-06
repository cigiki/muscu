<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CoeurAcier</title>
<style>
/* Styles généraux */
/* =========================
   THEME COEUR D’ACIER 💪
   ========================= */

   body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
    color: #fff;
}

h1 {
    text-align: center;
    color: #ff2e2e;
    margin-bottom: 30px;
    font-size: 2.8em;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 0 0 10px rgba(255,46,46,0.4);
}

/* =========================
   TABLE
   ========================= */

table {
    border-collapse: collapse;
    width: 100%;
    background-color: #151515;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0,0,0,0.8);
}

th {
    background: #1f1f1f;
    color: #ff2e2e;
    padding: 15px;
    text-align: center;
    font-weight: bold;
    text-transform: uppercase;
    border-bottom: 2px solid #ff2e2e;
}

td {
    vertical-align: top;
    border: 1px solid #2a2a2a;
}

/* Colonne Exercice */
td:first-child {
    background-color: #1a1a1a;
    padding: 15px;
    width: 15%;
}

/* =========================
   ZONES DE DEPOT
   ========================= */

.dropz {
    height: 1000px;
    width: 100%;
    background-color: #121212;
    border-radius: 8px;
    padding: 8px;
    overflow-y: auto;
}

/* =========================
   EXERCICES (DRAG & DROP)
   ========================= */

.exo {
    width: 86%;
    padding: 12px;
    margin: 6px 0;
    background: linear-gradient(135deg, #ff2e2e, #b30000);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: move;
    transition: all 0.25s ease;
    font-size: 14px;
    text-align: center;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.6);
}

.exo:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,46,46,0.6);
}

/* =========================
   BOUTONS MUSCLE GROUP
   ========================= */

button {
    width: 93%;
    padding: 12px;
    margin: 6px 0;
    background: #2a2a2a;
    color: #fff;
    border: 1px solid #ff2e2e;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.25s;
}

button:hover {
    background: #ff2e2e;
    color: #000;
}

/* =========================
   TITRES SECTIONS
   ========================= */

h3 {
    color: #ff2e2e;
    margin-top: 20px;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #ff2e2e;
    text-transform: uppercase;
    font-size: 16px;
}

/* =========================
   SEPARATEUR
   ========================= */

hr {
    margin: 40px 0;
    border: none;
    border-top: 2px solid #2a2a2a;
}

/* =========================
   BOUTONS BAS DE PAGE
   ========================= */

input[type="submit"],
a.btn {
    display: inline-block;
    padding: 12px 18px;
    margin: 10px 5px;
    background: #ff2e2e;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: 0.25s;
}

input[type="submit"]:hover,
a.btn:hover {
    background: #b30000;
}

/* =========================
   RESPONSIVE
   ========================= */

@media (max-width: 1200px) {
    body {
        padding: 10px;
    }

    h1 {
        font-size: 2em;
    }

    .dropz {
        height: 350px;
    }
}

</style>
<script>
let counter = 0;

function enleveExo(event) {
    event.preventDefault();
    event.currentTarget.remove();
}


function dragstartHandler(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function dragoverHandler(ev) {
  ev.preventDefault();
}

function newid(){
    counter++;
    return("homemade"+counter);
}

/**
 * @param ev l'evenement drop
 */
function dropHandler(ev) {
  ev.preventDefault();
  const data = ev.dataTransfer.getData("text");
  
  // Créer une copie de l'élément original
  const originalElement = document.getElementById(data);
  const newElement = originalElement.cloneNode(true);
  newElement.id = newid();
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('ondragstart', 'dragstartHandler(event)');
  nomEx=newElement.innerText.trim();
  




  //recup du jour
  //1 je recupere la colonne c'est la cible de l'evenement drop
  maColonne=ev.target;

  //2 je recupere l'id de la colonne
  monId=maColonne.id;


  //3 je recupere le numero du jour dans l'id de la colonne
  monNumJour=monId.substr(2)
  
  
  
  
  monHtml=`<input type='hidden' name='nomExo[]' value='${nomEx}' />`;
  newElement.insertAdjacentHTML('afterbegin',monHtml);
  monHtml=`<input type='hidden' name='jours[]' value='${monNumJour}' />`;
  newElement.insertAdjacentHTML('afterbegin',monHtml);
  // Ajouter la copie à la zone de dépôt
  ev.target.appendChild(newElement);
}


</script>
</head>
<body>
    <h1>CoeurAcier</h1>
    <form action="<?= site_url('planning/sauvegarder') ?>" method="post">
    <input type="hidden" name="user_id" value="<?= $user_id ?>">

    <table border="1" height="100%">
        <tr>
            <th width="15%">Exercice</th>
            <th width="12%">Lundi</th>
            <th width="12%">Mardi</th>
            <th width="12%">Mercredi</th>
            <th width="12%">Jeudi</th>
            <th width="12%">Vendredi</th>
            <th width="12%">Samedi</th>
            <th width="12%">Dimanche</th>
        </tr>
        <tr height="100%">
            <td valign="top">
                <div>
                    <h3>Muscle Group</h3>
                    <button>Pecs</button>
                    <button>Dos</button>
                    <button>Épaules</button>
                    <button>Biceps</button>
                    <button>Triceps</button>
                    <button>Avant-bras</button>
                    <button>Abdos</button>
                    <button>Jambes</button>
                    <button>Trapez</button>
                    <button>Échauffement</button>
                </div>
                <div>
                    <h3>Exercices</h3>
                    <div id="exos" ondrop="dropHandler(event)" ondragover="dragoverHandler(event)">
                        <div class="exo" id="ex1" draggable="true" ondragstart="dragstartHandler(event)">
                            Pompes
                        </div>
                        <div class="exo" id="ex2" draggable="true" ondragstart="dragstartHandler(event)">
                            squat
                        </div>
                        <div class="exo" id="ex3" draggable="true" ondragstart="dragstartHandler(event)">
                            rowing
                        </div>
                    </div>
                </div>
            </td>
            
            
           
            <?php

            for ($i=1;$i<=7;$i++){
            ?>
            
            <td>
                <div class="dropz" id="dz<?php echo $i;?>" ondrop="dropHandler(event)" ondragover="dragoverHandler(event)">
                <?php
                    //la variable $planifications est passée en parametre de la vue par le controlleur
                    foreach($planifications as $planif){
                        
                        if ($planif->numJour===$i){
                            //recup exo
                            $exo=$planif->exercice;
                            
                            $nomEx=$exo->nom;
                            $monNumJour=$planif->numJour;
                            echo '<div class="exo" id="'.$exo->id.'" draggable="true" oncontextmenu="enleveExo(event)" ondragstart="dragstartHandler(event)">'."<input type='hidden' name='nomExo[]' value='".$nomEx."' />"."<input type='hidden' name='jours[]' value='{$monNumJour}' />".$exo->nom.'</div>';
                       
                        }
                    }
                ?>
                </div>
            </td>


            <?php
                }
            ?>



        </tr>
    </table>
    
    <hr>





    
    <input type="submit" value="Envoyer"/>
    <a href="<?php echo base_url(); ?>/connexion" class="btn">Connexion</a>
    <a href="<?php echo base_url(); ?>/inscription" class="btn btn-secondary">Inscription</a>
    <a href="<?php echo base_url(); ?>/profileuti" class="btn btn-secondary">Profil utilisateur</a>

</form>
    <h3>Tache à faire</h3>
    
    <p>Condition de l'utilisateur en message / ou champs à remplir par l'utilisateur</p>
</body>
</html>