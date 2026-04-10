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

$routes->get('profileuti', 'ProfileController::index',['filter' => 'AuthGuard']);


$routes->get('planning', 'PlanningController::index',['filter' => 'AuthGuard']);
$routes->post('planning/sauvegarder', 'PlanningController::sauvegarder',['filter' => 'AuthGuard']);

$routes->get('service/add-exercice', 'PlanningServiceController::addExercice',['filter' => 'AuthGuard']);


// Route pour obtenir le token (NON protégée)
$routes->get('get-token', 'PlanningServiceController::getToken');

// Route protégée par JWT
$routes->get('service/planning-semaine', 'PlanningServiceController::getPlanningSemaine', ['filter' => 'JWTAuthGuard']);

$routes->post('webservice/login', 'ApiConnexionController::login');
$routes->post('webservice/register', 'ApiInscriptionController::register');