<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index', ['filter' => 'noauth']);
$routes->get('/login', 'Login::index', ['filter' => 'noauth']);
$routes->post('/signin', 'Login::signin', ['filter' => 'noauth']);
$routes->get('/signout', 'Login::signout');

// ** PROFILE ADMIN PAROKI & LINGKUNGAN
$routes->group('/user', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'User\Admin::index');
    $routes->get('profile/edit', 'User\Admin::edit');
    $routes->post('profile/update', 'User\Admin::editData');

    $routes->get('password', 'User\Admin::password');
    $routes->post('password/update', 'User\Admin::editPassword');

    $routes->get('security', 'User\Admin::first');
    $routes->post('security/password', 'User\Admin::passwordLogin');
});

// ** ADMIN PAROKI
$routes->group('/admin', ['filter' => 'authParoki'], function ($routes) {
    $routes->get('', 'Admin\Dashboard::index');
    $routes->get('setting', 'Admin\Settings::index');
    $routes->post('setting/update', 'Admin\Settings::editDataParoki');

    $routes->get('paroki', 'Admin\Admin::index');
    $routes->get('paroki', 'Admin\Admin::index');
    $routes->get('paroki/add', 'Admin\Admin::add');
    $routes->post('paroki/save', 'Admin\Admin::addData');
    $routes->get('paroki/(:segment)', 'Admin\Admin::detail/$1');
    $routes->get('paroki/edit/(:segment)', 'Admin\Admin::edit/$1');
    $routes->post('paroki/update/(:segment)', 'Admin\Admin::editData/$1');
    $routes->delete('paroki/delete/(:segment)', 'Admin\Admin::delete/$1');

    $routes->get('lingkungan', 'Admin\Lingkungan::index');
    $routes->get('lingkungan/add', 'Admin\Lingkungan::add');
    $routes->post('lingkungan/save', 'Admin\Lingkungan::addData');
    $routes->get('lingkungan/edit/(:segment)', 'Admin\Lingkungan::edit/$1');
    $routes->post('lingkungan/update/(:segment)', 'Admin\Lingkungan::editData/$1');

    $routes->get('aktivitas', 'Admin\Aktivitas::index');
    $routes->get('aktivitas/add', 'Admin\Aktivitas::add');
    $routes->post('aktivitas/save', 'Admin\Aktivitas::addData');
    $routes->get('aktivitas/edit/(:segment)', 'Admin\Aktivitas::edit/$1');
    $routes->post('aktivitas/update/(:segment)', 'Admin\Aktivitas::editData/$1');

    $routes->get('kategorial', 'Admin\Kategorial::index');
    $routes->get('kategorial/add', 'Admin\Kategorial::add');
    $routes->post('kategorial/save', 'Admin\Kategorial::addData');
    $routes->get('kategorial/edit/(:segment)', 'Admin\Kategorial::edit/$1');
    $routes->post('kategorial/update/(:segment)', 'Admin\Kategorial::editData/$1');

    $routes->get('pekerjaan', 'Admin\Pekerjaan::index');
    $routes->get('pekerjaan/add', 'Admin\Pekerjaan::add');
    $routes->post('pekerjaan/save', 'Admin\Pekerjaan::addData');
    $routes->get('pekerjaan/edit/(:segment)', 'Admin\Pekerjaan::edit/$1');
    $routes->post('pekerjaan/update/(:segment)', 'Admin\Pekerjaan::editData/$1');

    $routes->get('pendidikan', 'Admin\Pendidikan::index');

    $routes->match(['get', 'post'], 'keluarga', 'Admin\Keluarga::index');
    $routes->get('keluarga/add', 'Admin\Keluarga::add');
    $routes->post('keluarga/save', 'Admin\Keluarga::addData');
    $routes->get('keluarga/(:segment)', 'Admin\Keluarga::detail/$1');
    $routes->get('keluarga/edit/(:segment)', 'Admin\Keluarga::edit/$1');
    $routes->post('keluarga/update/(:segment)', 'Admin\Keluarga::editData/$1');
    $routes->get('keluarga/print/(:segment)', 'Admin\Keluarga::print/$1');

    $routes->get('keluarga/export/data', 'Admin\Keluarga::ex');
    $routes->post('keluarga/export/save', 'Admin\Keluarga::export');

    $routes->get('anggota/(:segment)', 'Admin\Anggota::detail/$1');
    $routes->get('anggota/add/(:segment)', 'Admin\Anggota::add/$1');
    $routes->post('anggota/save/(:segment)', 'Admin\Anggota::addData/$1');
    $routes->get('anggota/edit/(:segment)', 'Admin\Anggota::edit/$1');
    $routes->post('anggota/update/(:segment)', 'Admin\Anggota::editData/$1');
    $routes->post('anggota/head/(:segment)', 'Admin\Anggota::kepalaKeluarga/$1');
    $routes->delete('anggota/delete/(:segment)', 'Admin\Anggota::delete/$1');

    $routes->match(['get', 'post'], 'demografi', 'Admin\Demografi::index');
});

// ** ADMIN LINGKUNGAN
$routes->group('/lingkungan', ['filter' => 'authLingkungan'], function ($routes) {
    $routes->get('', 'AdminLingkungan\Dashboard::index');

    $routes->match(['get', 'post'], 'keluarga', 'AdminLingkungan\Keluarga::index');
    $routes->get('keluarga/add', 'AdminLingkungan\Keluarga::add');
    $routes->post('keluarga/save', 'AdminLingkungan\Keluarga::addData');
    $routes->get('keluarga/(:segment)', 'AdminLingkungan\Keluarga::detail/$1');
    $routes->get('keluarga/edit/(:segment)', 'AdminLingkungan\Keluarga::edit/$1');
    $routes->post('keluarga/update/(:segment)', 'AdminLingkungan\Keluarga::editData/$1');

    $routes->get('anggota/(:segment)', 'AdminLingkungan\Anggota::detail/$1');
    $routes->get('anggota/add/(:segment)', 'AdminLingkungan\Anggota::add/$1');
    $routes->post('anggota/save/(:segment)', 'AdminLingkungan\Anggota::addData/$1');
    $routes->get('anggota/edit/(:segment)', 'AdminLingkungan\Anggota::edit/$1');
    $routes->post('anggota/update/(:segment)', 'AdminLingkungan\Anggota::editData/$1');
    $routes->post('anggota/head/(:segment)', 'AdminLingkungan\Anggota::kepalaKeluarga/$1');
    $routes->delete('anggota/delete/(:segment)', 'AdminLingkungan\Anggota::delete/$1');

    $routes->get('demografi', 'AdminLingkungan\Demografi::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
