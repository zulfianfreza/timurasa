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
$routes->get('/', 'Supplier::index');
$routes->get('/second_step', 'Supplier::viewSecondStep');
$routes->get('/third_step', 'Supplier::viewThirdStep');
$routes->get('/fourth_step', 'Supplier::viewFourthStep');
$routes->get('/fifth_step', 'Supplier::viewFifthStep');

$routes->post('/save/first_step', 'Supplier::saveFirstStep');
$routes->post('/save/second_step', 'Supplier::saveSecondStep');
$routes->post('/save/third_step', 'Supplier::saveThirdStep');
$routes->post('/save/fourth_step', 'Supplier::saveFourthStep');
$routes->post('/save/fifth_step', 'Supplier::saveFifthStep');

$routes->get('/supplier?(:any)', 'Supplier::getSupplierById/$1');

$routes->get('/login', 'Auth::index');
$routes->post('/login/auth', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'authfilter'], function ($routes) {

    $routes->get('/', 'admin\Dashboard::index');

    $routes->get('profile', 'admin\Profile::index');
    $routes->get('profile/update/(:any)', 'admin\Profile::viewUpdate/$1');
    $routes->patch('profile/update/(:any)', 'admin\Profile::actionUpdate/$1');

    $routes->get('supplier', 'admin\Supplier::index');

    $routes->get('supplier/first_step', 'admin\Supplier::viewFirstStep');
    $routes->get('supplier/second_step', 'admin\Supplier::viewSecondStep');
    $routes->get('supplier/third_step', 'admin\Supplier::viewThirdStep');
    $routes->get('supplier/fourth_step', 'admin\Supplier::viewFourthStep');
    $routes->get('supplier/fifth_step', 'admin\Supplier::viewFifthStep');

    $routes->post('supplier/save/first_step', 'admin\Supplier::saveFirstStep');
    $routes->post('supplier/save/second_step', 'admin\Supplier::saveSecondStep');
    $routes->post('supplier/save/third_step', 'admin\Supplier::saveThirdStep');
    $routes->post('supplier/save/fourth_step', 'admin\Supplier::saveFourthStep');
    $routes->post('supplier/save/fifth_step', 'admin\Supplier::saveFifthStep');

    $routes->get('supplier/edit/first/(:any)', 'admin\Supplier::viewUpdateFirst/$1');
    $routes->get('supplier/edit/second/(:any)', 'admin\Supplier::viewUpdateSecond/$1');
    $routes->get('supplier/edit/third/(:any)', 'admin\Supplier::viewUpdateThird/$1');
    $routes->get('supplier/edit/fourth/(:any)', 'admin\Supplier::viewUpdateFourth/$1');
    $routes->get('supplier/edit/fifth/(:any)', 'admin\Supplier::viewUpdateFifth/$1');

    $routes->post('supplier/update/first/(:any)', 'admin\Supplier::actionUpdateFirst/$1');
    $routes->post('supplier/update/second/(:any)', 'admin\Supplier::actionUpdateSecond/$1');
    $routes->post('supplier/update/third/(:any)', 'admin\Supplier::actionUpdateThird/$1');
    $routes->post('supplier/update/fourth/(:any)', 'admin\Supplier::actionUpdateFourth/$1');
    $routes->post('supplier/update/fifth/(:any)', 'admin\Supplier::actionUpdateFifth/$1');

    $routes->get('document/delete/(:any)/(:any)', 'admin\Supplier::deleteDocument/$1/$2');

    $routes->get('supplier/export/excel', 'admin\Supplier::exportToExcel');
    $routes->get('supplier/update/(:any)', 'admin\Supplier::viewUpdate/$1');
    $routes->patch('supplier/update/(:any)', 'admin\Supplier::actionUpdate/$1');
    $routes->get('supplier/(:any)', 'admin\Supplier::getSupplierById/$1');
    $routes->delete('supplier/(:any)', 'admin\Supplier::actionDelete/$1');
    $routes->patch('supplier/verification/(:any)/(:any)', 'admin\Supplier::verificationSupplier/$1/$2');

    $routes->get('document/(:any)', 'admin\Supplier::documentView/$1');

    $routes->get('product', 'admin\Product::index');
    $routes->get('product/create', 'admin\Product::viewCreate');
    $routes->post('product/create', 'admin\Product::actionCreate');
    $routes->get('product/update/(:any)', 'admin\Product::viewUpdate/$1');
    $routes->patch('product/update/(:any)', 'admin\Product::actionUpdate/$1');
    $routes->patch('product/(:any)', 'admin\Product::setActive/$1');
    $routes->delete('product/delete/(:any)', 'admin\Product::actionDelete/$1');

    $routes->get('service', 'admin\Service::index');
    $routes->get('service/create', 'admin\Service::viewCreate');
    $routes->post('service/create', 'admin\Service::actionCreate');
    $routes->get('service/update/(:any)', 'admin\Service::viewUpdate/$1');
    $routes->patch('service/update/(:any)', 'admin\Service::actionUpdate/$1');
    $routes->patch('service/(:any)', 'admin\Service::setActive/$1');
    $routes->delete('service/delete/(:any)', 'admin\Service::actionDelete/$1');

    $routes->get('user', 'admin\User::index');
    $routes->get('user/create', 'admin\User::viewCreate');
    $routes->post('user/create', 'admin\User::actionCreate');
    // $routes->get('other/edit/(:any)', 'admin\OtherCategory::edit/$1');
    // $routes->patch('other/(:any)', 'admin\OtherCategory::setActive/$1');
    // $routes->patch('other/update/(:any)', 'admin\OtherCategory::update/$1');
    $routes->delete('user/delete/(:any)', 'admin\User::actionDelete/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
