<?php

use CodeIgniter\Router\RouteCollection;

<<<<<<< HEAD
=======
/**
 * @var RouteCollection $routes
 */

// Halaman utama
>>>>>>> 30f009ee730c0ea0e99a7ee3216cf03ee4724b75
$routes->get('/', 'Kerajaan::index');

// Group Admin
$routes->group('admin', function($routes) {

    // Dashboard & halaman utama admin
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

    // View Materi
    $routes->get('view-materi/(:num)', 'Admin\ViewMateri::index/$1');

    // ===== TAMBAHKAN ROUTES UNTUK VIEW VIDEO =====
   
    $routes->get('view-video/(:any)', 'Admin\ViewVideo::index/$1');
    $routes->post('video/delete', 'Admin\ViewVideo::deleteVideo');
    $routes->post('video/delete-comment', 'Admin\ViewVideo::deleteComment');
    // =============================================

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

    // Delete Materi
    $routes->post('delete_materi', 'Admin\Materi::deleteMateri');

    // Tambah Soal
    $routes->get('tambah-soal', 'Admin\TambahSoal::index');
    $routes->post('tambah-soal', 'Admin\TambahSoal::store');

    // Tambah Video
    $routes->get('tambah-video', 'Admin\TambahVideo::index');
    $routes->post('tambah-video', 'Admin\TambahVideo::save');
    $routes->get('update-video/(:segment)', 'Admin\UpdateVideo::index/$1');
    $routes->post('update-video/update/(:segment)', 'Admin\UpdateVideo::update/$1');

    $routes->post('delete-video', 'Admin\Materi::deleteVideo');

    $routes->get('tambah-soal', 'Admin\TambahSoal::index');
    $routes->post('tambah-soal/simpan', 'Admin\TambahSoal::simpan');

    $routes->post('delete-soal', 'Admin\Materi::deleteSoal/$1');

    // Di dalam group admin, tambahkan:
    $routes->get('update-soal/(:num)', 'Admin\UpdateSoal::index/$1');
    $routes->post('update-soal/(:num)', 'Admin\UpdateSoal::update/$1');

    $routes->get('soal/view/(:num)', 'Admin\ViewSoal::index/$1');
    $routes->get('view-soal/(:num)', 'Admin\ViewSoal::index/$1');
// Routes untuk raja
$routes->get('mapel/(:any)/raja', 'Admin\Raja::index/$1');
$routes->get('raja/create/(:any)', 'Admin\Raja::create/$1');
$routes->post('raja/store/(:any)', 'Admin\Raja::store/$1');
$routes->get('raja/edit/(:num)', 'Admin\Raja::edit/$1');
$routes->post('raja/update/(:num)', 'Admin\Raja::update/$1');
$routes->get('raja/delete/(:num)', 'Admin\Raja::delete/$1');
    // Login routes
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

});
    // Login routes
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

// Di dalam group admin:
// Di dalam group admin, TAMBAHKAN routes ini:


// Halaman Tentang
$routes->get('/tentang', 'TentangController::index');
$routes->get('/tentang', 'TentangController::index');
$routes->get('kerajaan/detail/(:segment)', 'Kerajaan::detail/$1');

$routes->get('/kerajaan', 'DaftarKerajaan::index'); // masih boleh
$routes->get('/daftar', 'DaftarKerajaan::index');   // tambahan baru

$routes->get('/peta', 'PetaController::index');
