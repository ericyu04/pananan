<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/tasks', 'Tasks::index');
$routes->get('/profile', 'Pages::profile');
$routes->get('/about', 'Pages::about');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attempt');
$routes->get('/logout', 'Auth::logout');

$routes->get('/tasks/new', 'Tasks::new', ['filter' => 'auth']);
$routes->post('/tasks', 'Tasks::create', ['filter' => 'auth']);
$routes->get('/tasks/edit/(:num)', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/edit/(:num)', 'Tasks::update/$1', ['filter' => 'auth']);
$routes->post('/tasks/delete/(:num)', 'Tasks::archive/$1', ['filter' => 'auth']);

// TEMPORARY
//$routes->get('/setup-demo', 'Auth::setupDemo');