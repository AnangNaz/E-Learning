<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Kerajaan::index');
$routes->get('/tentang', 'TentangController::index');
$routes->get('kerajaan/detail/(:segment)', 'Kerajaan::detail/$1');
$routes->get('/kerajaan', 'DaftarKerajaan::index');
$routes->get('/peta', 'PetaController::index');
