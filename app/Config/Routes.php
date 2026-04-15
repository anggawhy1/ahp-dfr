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

// 2. Routes untuk User / Kampus (Terkunci oleh Filter 'authUser')
$routes->group('user', ['filter' => 'authUser'], static function ($routes) {
    $routes->get('assessment', 'AssessmentController::index');
    $routes->post('assessment/submit', 'AssessmentController::submit');
    $routes->get('dashboard', 'AssessmentController::dashboard');
    $routes->get('export/(:num)', 'AssessmentController::export_pdf/$1');
    $routes->get('profile', 'AssessmentController::profile');
    $routes->post('profile/update', 'AssessmentController::update_profile');
    $routes->get('history', 'AssessmentController::history');
});

// 3. Routes untuk Admin Pusat (Terkunci oleh Filter 'authAdmin')
$routes->group('admin', ['filter' => 'authAdmin'], static function ($routes) {
    $routes->get('dashboard', 'AssessmentController::admin_dashboard');
    $routes->get('rekap', 'AssessmentController::admin_rekap');
    $routes->get('detail/(:num)', 'AssessmentController::admin_detail/$1');
    $routes->get('export/(:num)', 'AssessmentController::export_pdf/$1');
    $routes->get('profile', 'AssessmentController::admin_profile');
    $routes->post('profile/update', 'AssessmentController::admin_update_profile');
});
