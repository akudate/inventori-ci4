<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AppController::dashboard');
$routes->get('/', 'AppController::jumlah_dashboard');
$routes->get("profile", "AppController::profile");
$routes->get("register", "RegistController::register");
$routes->post("proses_register", "RegistController::proses_register");
$routes->get("login", "LoginController::login");
$routes->post("proses_login", "LoginController::proses_login");
$routes->get("logout", "AppController::logout");

// Tabel Supplier
$routes->get("data_supplier", "AppController::data_supplier");
$routes->get("tambah_supplier", "AppController::tambah_supplier");
$routes->post("proses_tambah_supplier", "AppController::proses_tambah_supplier");
$routes->get("supplier/(:any)/hapus", "AppController::hapus_supplier/$1");
$routes->get("supplier/(:any)/edit", "AppController::edit_supplier/$1");
$routes->post("proses_edit_supplier", "AppController::proses_edit_supplier");

// Tabel Barang
$routes->get("data_barang", "AppController::data_barang");
$routes->get("tambah_barang", "AppController::tambah_barang");
$routes->post("proses_tambah_barang", "AppController::proses_tambah_barang");
$routes->get("barang/(:any)/hapus", "AppController::hapus_barang/$1");
$routes->get("barang/(:any)/edit", "AppController::edit_barang/$1");
$routes->post("proses_edit_barang", "AppController::proses_edit_barang");

// Tabel Barang Masuk
$routes->get("data_barangmasuk", "AppController::data_barangmasuk");
$routes->get("tambah_barangmasuk", "AppController::tambah_barangmasuk");
$routes->post("proses_tambah_barangmasuk", "AppController::proses_tambah_barangmasuk");
$routes->get("barangmasuk/(:any)/(:any)/(:any)/hapus", "AppController::hapus_barangmasuk/$1/$2/$3");
$routes->get("barangmasuk/(:any)/edit", "AppController::edit_barangmasuk/$1");
$routes->post("proses_edit_barangmasuk", "AppController::proses_edit_barangmasuk/$1");

// Tabel Barang Keluar
$routes->get("data_barangkeluar", "AppController::data_barangkeluar");
$routes->get("tambah_barangkeluar", "AppController::tambah_barangkeluar");
$routes->post("proses_tambah_barangkeluar", "AppController::proses_tambah_barangkeluar");
$routes->get("barangkeluar/(:any)/(:any)/(:any)/hapus", "AppController::hapus_barangkeluar/$1/$2/$3");
$routes->get("barangkeluar/(:any)/edit", "AppController::edit_barangkeluar/$1");
$routes->post("proses_edit_barangkeluar", "AppController::proses_edit_barangkeluar/$1");

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
