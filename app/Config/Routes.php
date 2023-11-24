<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index'); 
$routes->post('/login', 'LoginController::store'); 
$routes->get('/logout', 'LoginController::logout'); 

$routes->get('/registration', 'RegistrasiController::index'); 
$routes->post('/registration/store', 'RegistrasiController::store'); 

$routes->get('/homepage', 'HomepageController::index', ['filter' => 'auth']); 

