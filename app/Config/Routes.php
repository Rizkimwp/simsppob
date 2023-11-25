<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Route Login
$routes->get('/', 'LoginController::index'); 
$routes->post('/login', 'LoginController::store'); 
$routes->get('/logout', 'LoginController::logout'); 
// Route Registrasi
$routes->get('/registration', 'RegistrasiController::index'); 
$routes->post('/registration/store', 'RegistrasiController::store');


// Route Homepage
$routes->get('/homepage', 'HomepageController::index', ['filter' => 'auth']);  
$routes->get('/topup', 'TopupController::index', ['filter' => 'auth']);  
$routes->post('/topup/store', 'TopupController::topup');  
$routes->get('/transaksi', 'TransaksiController::index');  


