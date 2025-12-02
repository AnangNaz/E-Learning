<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama
$routes->get('/', 'Kerajaan::index');

// Group Admin
$routes->group('admin', function($routes) {

    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('materi', 'Admin\Materi::index');
    $routes->get('mapel', 'Admin\Mapel::index');
    $routes->get('soal', 'Admin\Soal::index');
    $routes->get('profile', 'Admin\Profile::index');

    // CRUD Mapel
    $routes->get('mapel/delete/(:segment)', 'Admin\Mapel::delete/$1');
    $routes->get('mapel/update/(:segment)', 'Admin\Mapel::update/$1');

    // DETAIL MAPEL (View Mapel)
    $routes->get('mapel/view/(:segment)', 'Admin\ViewMapel::index/$1');

    $routes->get('view-materi/(:num)', 'Admin\ViewMateri::index/$1');


    // Tambah Mapel
    $routes->get('tambah-mapel', 'Admin\TambahMapel::index');
    $routes->post('tambah-mapel', 'Admin\TambahMapel::store');

    // Tambah Materi
    $routes->get('tambah-materi', 'Admin\TambahMateri::index');
    $routes->post('tambah-materi', 'Admin\TambahMateri::store');

    // Update Mapel
    $routes->get('update-mapel/(:segment)', 'Admin\UpdateMapel::index/$1');
    $routes->post('update-mapel/(:segment)', 'Admin\UpdateMapel::update/$1');

    // Update Materi
    $routes->get('update-materi/(:segment)', 'Admin\UpdateMateri::index/$1');
    $routes->post('update-materi/(:segment)', 'Admin\UpdateMateri::update/$1');

    // Update Mapel
    $routes->post('delete_materi', 'Admin\Materi::deleteMateri'); // <-- ini


});

