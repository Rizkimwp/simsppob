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
// Route Top up
$routes->get('/topup', 'TopupController::index', ['filter' => 'auth']);  
$routes->post('/topup/store', 'TopupController::topup');  
// Route History Transaksi 
$routes->get('/history', 'HistoryController::index', ['filter' => 'auth']);  
$routes->get('/history/loadmore', 'HistoryController::loadMore', ['filter' => 'auth']);  
// Route Profile
$routes->get('/profile', 'ProfileController::index', ['filter' => 'auth']);  
$routes->post('/profile/update', 'ProfileController::update');  
$routes->put('/profile/update', 'ProfileController::update');  
$routes->put('/profile/image', 'ProfileController::updateImage');  
$routes->post('/profile/image', 'ProfileController::updateImage');  
// Route Transaksi Services
$routes->get('transaksi/(:segment)', 'TransaksiController::index/$1', ['filter' => 'auth']);
$routes->post('/transaksi', 'TransaksiController::store');


