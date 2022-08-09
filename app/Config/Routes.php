<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/profile', 'User::profile', ['filter' => 'role:admin,user']);
$routes->post('/updateProfile', 'User::updateProfile', ['filter' => 'role:admin,user']);
$routes->post('/uploadImg', 'User::uploadImg', ['filter' => 'role:admin,user']);

$routes->get('/getFaculty', 'User::getFaculty', ['filter' => 'role:user']);
$routes->get('/studentExchanges', 'User::studentExchanges', ['filter' => 'role:user']);
$routes->post('/appliedExchange', 'User::appliedExchange', ['filter' => 'role:user']);
$routes->post('/modalUpload', 'User::modalUpload', ['filter' => 'role:user']);

// $routes->get('/', 'Admin::index', ['filter' => 'role:admin']);
// $routes->get('/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/exchange', 'Admin::exchange', ['filter' => 'role:admin']);
$routes->get('/appliedPrograms', 'Admin::appliedPrograms', ['filter' => 'role:admin']);
$routes->get('/getUser', 'Admin::getUser', ['filter' => 'role:admin']);
$routes->get('/getExchange', 'Admin::getExchange', ['filter' => 'role:admin']);
$routes->get('/verificationUser', 'Admin::verificationUser', ['filter' => 'role:admin']);
$routes->get('/departement', 'Admin::departement', ['filter' => 'role:admin']);
$routes->get('/getFakultas', 'Admin::getFakultas', ['filter' => 'role:admin']);
$routes->get('/getDepartement', 'Admin::getDepartement', ['filter' => 'role:admin']);
$routes->get('/formFakultas', 'Admin::formFakultas', ['filter' => 'role:admin']);
$routes->get('/modalStatus', 'Admin::modalStatus', ['filter' => 'role:admin']);
$routes->get('/updateSettingormat', 'Admin::updateSettingormat', ['filter' => 'role:admin']);
$routes->get('/editFormat', 'Admin::editFormat', ['filter' => 'role:admin']);
$routes->get('/editSetting', 'Admin::editSetting', ['filter' => 'role:admin']);
$routes->get('/dataStatus', 'Admin::dataStatus', ['filter' => 'role:admin']);
$routes->get('/formDepartement', 'Admin::formDepartement', ['filter' => 'role:admin']);
$routes->post('/addStatus', 'Admin::addStatus', ['filter' => 'role:admin']);
$routes->post('/updateStatus', 'Admin::updateStatus', ['filter' => 'role:admin']);
$routes->post('/deleteStatus', 'Admin::deleteStatus', ['filter' => 'role:admin']);
$routes->post('/formDepartement', 'Admin::formDepartement', ['filter' => 'role:admin']);
$routes->post('/checklistDepartements', 'Admin::checklistDepartements', ['filter' => 'role:admin']);
$routes->post('/addFadep', 'Admin::addFadep', ['filter' => 'role:admin']);
$routes->post('/deleteFadep', 'Admin::deleteFadep', ['filter' => 'role:admin']);
$routes->post('/modalDepartements', 'Admin::modalDepartements', ['filter' => 'role:admin']);
$routes->post('/formFakultas', 'Admin::formFakultas', ['filter' => 'role:admin']);
$routes->post('/simpanFakultas', 'Admin::simpanFakultas', ['filter' => 'role:admin']);
$routes->post('/simpanDepartement', 'Admin::simpanDepartement', ['filter' => 'role:admin']);
$routes->post('/updateFakultas', 'Admin::updateFakultas', ['filter' => 'role:admin']);
$routes->post('/updateDepartement', 'Admin::updateDepartement', ['filter' => 'role:admin']);
$routes->post('/toggleFakultas', 'Admin::toggleFakultas', ['filter' => 'role:admin']);
$routes->post('/toggleKuota', 'Admin::toggleKuota', ['filter' => 'role:admin']);
$routes->post('/deleteFakultas', 'Admin::deleteFakultas', ['filter' => 'role:admin']);
$routes->post('/deleteDepartement', 'Admin::deleteDepartement', ['filter' => 'role:admin']);
$routes->post('/acceptUser', 'Admin::acceptUser', ['filter' => 'role:admin']);
$routes->post('/deleteUser', 'Admin::deleteUser', ['filter' => 'role:admin']);
$routes->post('/deleteExchange', 'Admin::deleteExchange', ['filter' => 'role:admin']);
$routes->post('/updateExchangeStatus', 'Admin::updateExchangeStatus', ['filter' => 'role:admin']);
$routes->post('/modalUser', 'Admin::modalUser', ['filter' => 'role:admin']);
$routes->post('/updateUser', 'Admin::updateUser', ['filter' => 'role:admin']);
$routes->post('/updateLoa', 'Admin::updateLoa', ['filter' => 'role:admin']);
$routes->post('/updateVisa', 'Admin::updateVisa', ['filter' => 'role:admin']);
$routes->post('/getUsersExchange', 'Admin::getUsersExchange', ['filter' => 'role:admin']);
$routes->post('/updateFormat', 'Admin::updateFormat', ['filter' => 'role:admin']);
$routes->post('/updateSetting', 'Admin::updateSetting', ['filter' => 'role:admin']);

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
