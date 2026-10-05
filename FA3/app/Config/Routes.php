<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/customers', 'Customers::index');
$routes->get('/users', 'Users::index');

$routes->get('/customers/new', 'Customers::new');
$routes->post('/customers', 'Customers::create');
$routes->get('/customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('/customers/edit/(:num)', 'Customers::update/$1');


$routes ->get('/users/new', 'Users::new');
$routes->post('/users', 'Users::create');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/edit/(:num)', 'Users::update/$1');

