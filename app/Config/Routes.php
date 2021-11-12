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
$routes->get('/login', 'Login::index', ['filter' => 'noauth']);
$routes->post('/signin', 'Login::signin', ['filter' => 'noauth']);
$routes->get('/signout', 'Login::signout', ['filter' => 'auth']);

$routes->get('/admin', 'Admin\Dashboard::index', ['filter' => 'auth']);

$routes->get('/admin/setting', 'Admin\Settings::index', ['filter' => 'auth']);
$routes->post('/admin/setting/update', 'Admin\Settings::editDataParoki', ['filter' => 'auth']);

$routes->get('/admin/paroki', 'Admin\Admin::index', ['filter' => 'auth']);
$routes->get('/admin/paroki', 'Admin\Admin::index', ['filter' => 'auth']);
$routes->get('/admin/paroki/add', 'Admin\Admin::add', ['filter' => 'auth']);
$routes->post('/admin/paroki/save', 'Admin\Admin::addData', ['filter' => 'auth']);
$routes->get('/admin/paroki/(:segment)', 'Admin\Admin::detail/$1', ['filter' => 'auth']);
$routes->get('/admin/paroki/edit/(:segment)', 'Admin\Admin::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/paroki/update/(:segment)', 'Admin\Admin::editData/$1', ['filter' => 'auth']);
$routes->delete('/admin/paroki/delete/(:segment)', 'Admin\Admin::delete/$1', ['filter' => 'auth']);

$routes->get('/admin/lingkungan', 'Admin\Lingkungan::index', ['filter' => 'auth']);
$routes->get('/admin/lingkungan/add', 'Admin\Lingkungan::add', ['filter' => 'auth']);
$routes->post('/admin/lingkungan/save', 'Admin\Lingkungan::addData', ['filter' => 'auth']);
$routes->get('/admin/lingkungan/edit/(:segment)', 'Admin\Lingkungan::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/lingkungan/update/(:segment)', 'Admin\Lingkungan::editData/$1', ['filter' => 'auth']);

$routes->get('/admin/aktivitas', 'Admin\Aktivitas::index', ['filter' => 'auth']);
$routes->get('/admin/aktivitas/add', 'Admin\Aktivitas::add', ['filter' => 'auth']);
$routes->post('/admin/aktivitas/save', 'Admin\Aktivitas::addData', ['filter' => 'auth']);
$routes->get('/admin/aktivitas/edit/(:segment)', 'Admin\Aktivitas::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/aktivitas/update/(:segment)', 'Admin\Aktivitas::editData/$1', ['filter' => 'auth']);

$routes->get('/admin/kategorial', 'Admin\Kategorial::index', ['filter' => 'auth']);
$routes->get('/admin/kategorial/add', 'Admin\Kategorial::add', ['filter' => 'auth']);
$routes->post('/admin/kategorial/save', 'Admin\Kategorial::addData', ['filter' => 'auth']);
$routes->get('/admin/kategorial/edit/(:segment)', 'Admin\Kategorial::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/kategorial/update/(:segment)', 'Admin\Kategorial::editData/$1', ['filter' => 'auth']);

$routes->get('/admin/pekerjaan', 'Admin\Pekerjaan::index', ['filter' => 'auth']);
$routes->get('/admin/pekerjaan/add', 'Admin\Pekerjaan::add', ['filter' => 'auth']);
$routes->post('/admin/pekerjaan/save', 'Admin\Pekerjaan::addData', ['filter' => 'auth']);
$routes->get('/admin/pekerjaan/edit/(:segment)', 'Admin\Pekerjaan::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/pekerjaan/update/(:segment)', 'Admin\Pekerjaan::editData/$1', ['filter' => 'auth']);

$routes->get('/admin/pendidikan', 'Admin\Pendidikan::index', ['filter' => 'auth']);

$routes->match(['get', 'post'], '/admin/keluarga', 'Admin\Keluarga::index', ['filter' => 'auth']);
$routes->get('/admin/keluarga/add', 'Admin\Keluarga::add', ['filter' => 'auth']);
$routes->post('/admin/keluarga/save', 'Admin\Keluarga::addData', ['filter' => 'auth']);
$routes->get('/admin/keluarga/(:segment)', 'Admin\Keluarga::detail/$1', ['filter' => 'auth']);
$routes->get('/admin/keluarga/edit/(:segment)', 'Admin\Keluarga::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/keluarga/update/(:segment)', 'Admin\Keluarga::editData/$1', ['filter' => 'auth']);
$routes->get('/admin/keluarga/print/(:segment)', 'Admin\Keluarga::print/$1', ['filter' => 'auth']);

$routes->get('/admin/keluarga/export/data', 'Admin\Keluarga::ex', ['filter' => 'auth']);
$routes->post('/admin/keluarga/export/save', 'Admin\Keluarga::export', ['filter' => 'auth']);

$routes->get('/admin/anggota/(:segment)', 'Admin\Anggota::detail/$1', ['filter' => 'auth']);
$routes->get('/admin/anggota/add/(:segment)', 'Admin\Anggota::add/$1', ['filter' => 'auth']);
$routes->post('/admin/anggota/save/(:segment)', 'Admin\Anggota::addData/$1', ['filter' => 'auth']);
$routes->get('/admin/anggota/edit/(:segment)', 'Admin\Anggota::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/anggota/update/(:segment)', 'Admin\Anggota::editData/$1', ['filter' => 'auth']);
$routes->delete('/admin/anggota/delete/(:segment)', 'Admin\Anggota::delete/$1', ['filter' => 'auth']);

$routes->get('/admin/demografi', 'Admin\Demografi::index', ['filter' => 'auth']);

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
