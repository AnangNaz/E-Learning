<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==============================================
// PUBLIC ROUTES (NON-ADMIN)
// ==============================================

// Halaman utama
$routes->get('/', 'Kerajaan::index');

// Kerajaan & Peta
$routes->get('/kerajaan', 'DaftarKerajaan::index');
$routes->get('/daftar', 'DaftarKerajaan::index');
$routes->get('kerajaan/detail/(:segment)', 'Kerajaan::detail/$1');
$routes->get('/peta', 'PetaController::index');

// Tentang
$routes->get('/tentang', 'TentangController::index');

// Auth (Login & Register)
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');

// ==============================================
// ADMIN ROUTES
// ==============================================
$routes->group('admin', function($routes) {
    
    // ========== DASHBOARD & PROFILE ==========
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->get('update', 'Admin\Update::index');
    $routes->post('update/process', 'Admin\Update::process');
    
    // ========== MAIN PAGES ==========
    $routes->get('materi', 'Admin\Materi::index');
    $routes->get('mapel', 'Admin\Mapel::index');
    $routes->get('soal', 'Admin\Soal::index');
    
    // ========== MAPEL (KERAJAAN) ==========
    // CRUD Mapel
    $routes->get('tambah-mapel', 'Admin\TambahMapel::index');
    $routes->post('tambah-mapel', 'Admin\TambahMapel::store');
    $routes->get('mapel/view/(:segment)', 'Admin\ViewMapel::index/$1');
    $routes->get('mapel/update/(:segment)', 'Admin\Mapel::update/$1');
    $routes->get('mapel/delete/(:segment)', 'Admin\Mapel::delete/$1');
    
    // Update Mapel
    $routes->get('update-mapel/(:segment)', 'Admin\UpdateMapel::index/$1');
    $routes->post('update-mapel/(:segment)', 'Admin\UpdateMapel::update/$1');
    
    // Search Mapel
    $routes->get('search-mapel', 'Admin\SearchMapel::index');
    $routes->post('search-mapel', 'Admin\SearchMapel::index');
    $routes->post('search-mapel/delete/(:num)', 'Admin\SearchMapel::delete/$1');
    $routes->get('search-mapel/(:any)', 'Admin\SearchMapel::index');
    
    // ========== MATERI ==========
    $routes->get('tambah-materi', 'Admin\TambahMateri::index');
    $routes->post('tambah-materi', 'Admin\TambahMateri::store');
    $routes->get('update-materi/(:segment)', 'Admin\UpdateMateri::index/$1');
    $routes->post('update-materi/(:segment)', 'Admin\UpdateMateri::update/$1');
    $routes->get('view-materi/(:num)', 'Admin\ViewMateri::index/$1');
    $routes->post('delete_materi', 'Admin\Materi::deleteMateri');
    
    // ========== VIDEO ==========
    $routes->get('tambah-video', 'Admin\TambahVideo::index');
    $routes->post('tambah-video', 'Admin\TambahVideo::save');
    $routes->get('update-video/(:segment)', 'Admin\UpdateVideo::index/$1');
    $routes->post('update-video/update/(:segment)', 'Admin\UpdateVideo::update/$1');
    $routes->get('view-video/(:any)', 'Admin\ViewVideo::index/$1');
    $routes->post('delete-video', 'Admin\Materi::deleteVideo');
    $routes->post('video/delete', 'Admin\ViewVideo::deleteVideo');
    $routes->post('video/delete-comment', 'Admin\ViewVideo::deleteComment');
    
    // SoalController routes (for quiz management)
    $routes->get('soal/create', 'Admin\Soal::create');
    $routes->post('soal/store', 'Admin\Soal::store');
    $routes->get('soal/edit/(:num)', 'Admin\Soal::edit/$1');
    $routes->post('soal/update/(:num)', 'Admin\Soal::update/$1');
    $routes->post('delete-soal', 'Admin\Materi::deleteSoal');
    
    // ========== RAJA ==========
    $routes->get('mapel/(:segment)/raja', 'Admin\Raja::index/$1');
    $routes->get('raja/create/(:segment)', 'Admin\Raja::create/$1');
    $routes->post('raja/store/(:segment)', 'Admin\Raja::store/$1');
    $routes->get('raja/edit/(:num)', 'Admin\Raja::edit/$1');
    $routes->post('raja/update/(:num)', 'Admin\Raja::update/$1');
    $routes->get('raja/delete/(:num)', 'Admin\Raja::delete/$1');
    $routes->post('raja/store', 'Admin\Raja::store');
// Pastikan ini ada di routes.php
$routes->post('raja/delete/(:num)', 'Admin\Raja::delete/$1');

// Di app/Config/Routes.php
$routes->get('peristiwa/create', 'Admin\Peristiwa::create');
$routes->post('peristiwa/store', 'Admin\Peristiwa::store');
$routes->get('peristiwa/edit/(:num)', 'Admin\Peristiwa::edit/$1');
$routes->post('peristiwa/update/(:num)', 'Admin\Peristiwa::update/$1');
$routes->post('peristiwa/delete/(:num)', 'Admin\Peristiwa::delete/$1');
$routes->get('mapel/(:num)/peristiwa', 'Admin\Peristiwa::index/$1');
// Routes.php - ubah POST ke GET
$routes->get('peristiwa/delete/(:num)', 'Admin\Peristiwa::delete/$1');
});
