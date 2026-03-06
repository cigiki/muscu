<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d'accueil
$routes->get('/', function() {
    echo view('welcome_message');
});

// Routes inscription
$routes->get('inscription', 'InscriptionController::index');
$routes->post('inscription/traiteInscription', 'InscriptionController::traiteInscription');

// Routes connexion
$routes->get('connexion', 'ConnexionController::index');
$routes->post('connexion/traiteConnexion', 'ConnexionController::traiteConnexion');

$routes->get('profileuti', 'ProfileController::index');


$routes->get('planning', 'PlanningController::index');
$routes->post('planning/sauvegarder', 'PlanningController::sauvegarder');

$routes->get('service/add-exercice', 'PlanningServiceController::addExercice');


$routes->get('service/planning-semaine', 'PlanningServiceController::getPlanningSemaine');

