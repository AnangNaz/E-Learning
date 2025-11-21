<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Kerajaan::index');
$routes->get('/tentang', 'TentangController::index');
