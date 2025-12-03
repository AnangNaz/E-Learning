<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Kerajaan::index');
$routes->get('/tentang', 'TentangController::index');
$routes->get('kerajaan/detail/(:segment)', 'Kerajaan::detail/$1');

$routes->get('/kerajaan', 'DaftarKerajaan::index'); // masih boleh
$routes->get('/daftar', 'DaftarKerajaan::index');   // tambahan baru

$routes->get('/peta', 'PetaController::index');
