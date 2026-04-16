<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::landing');
$routes->get('/login', 'AuthController::index');
$routes->post('/login/process', 'AuthController::process');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::register_process');
$routes->get('/logout', 'AuthController::logout');

$routes->group('user', ['filter' => 'authUser'], static function ($routes) {
    $routes->get('assessment', 'AssessmentController::index');
    $routes->post('assessment/submit', 'AssessmentController::submit');
    $routes->get('dashboard', 'AssessmentController::dashboard');
    $routes->get('export/(:num)', 'AssessmentController::export_pdf/$1');
    $routes->get('profile', 'AssessmentController::profile');
    $routes->post('profile/update', 'AssessmentController::update_profile');
    $routes->get('history', 'AssessmentController::history');
});

$routes->group('admin', ['filter' => 'authAdmin'], static function ($routes) {
    $routes->get('dashboard', 'AssessmentController::admin_dashboard');
    $routes->get('rekap', 'AssessmentController::admin_rekap');
    $routes->get('detail/(:num)', 'AssessmentController::admin_detail/$1');
    $routes->get('export/(:num)', 'AssessmentController::export_pdf/$1');
    $routes->get('profile', 'AssessmentController::admin_profile');
    $routes->post('profile/update', 'AssessmentController::admin_update_profile');
    $routes->get('indikator', 'AssessmentController::admin_indikator');
    $routes->post('indikator/update_bobot', 'AssessmentController::admin_update_bobot');
    $routes->post('indikator/store', 'AssessmentController::admin_store_indikator');
    $routes->post('indikator/update/(:num)', 'AssessmentController::admin_update_indikator/$1');
    $routes->get('indikator/delete/(:num)', 'AssessmentController::admin_delete_indikator/$1');
});
