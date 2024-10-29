<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Controller');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();


$baseSubURL = env('app.baseDIR');
$backendPrefix = $baseSubURL . '/backend';


$routes->get($baseSubURL . '/', 'HomeController::index');
$routes->post($baseSubURL . '/content_activity', 'HomeController::load_content_activity');
$routes->get($baseSubURL . '/login', 'HomeController::login');
$routes->get($baseSubURL . '/logout', 'HomeController::logout');
$routes->get($baseSubURL . '/register', 'HomeController::register');
$routes->post($baseSubURL . '/loginAuth', 'HomeController::login_auth');
$routes->post($baseSubURL . '/addRegister', 'HomeController::add_register');
$routes->post($baseSubURL . '/check_duplicate', 'HomeController::check_duplicate');
$routes->get($baseSubURL . '/bookingActivity', 'HomeController::activity_book');
$routes->get($baseSubURL . '/activityDetails/(:any)', 'HomeController::activity_detail/$1');
$routes->post($baseSubURL . '/confirmBooking/(:any)/(:any)', 'HomeController::activity_confirm_booking/$1/$2');


$routes->match(['get', 'post'], $backendPrefix . '/login', 'BackendController::login');
$routes->get($backendPrefix . '/logout', 'BackendController::logout');

// Routes ที่ต้องผ่าน isAdmin filter
$routes->group($backendPrefix, ['filter' => 'isAdmin'], function ($routes) {
    // GET routes
    $routes->get('', 'BackendController::index');

    // POST routes for content loading
    $routes->post('contentDashboard', 'BackendController::load_content_dashboard');
    $routes->post('contentUser', 'BackendController::load_content_user');
    $routes->post('contentCategory', 'BackendController::load_content_category');
    $routes->post('contentActivity', 'BackendController::load_content_activity');
    $routes->post('contentAdministrator', 'BackendController::load_content_administrator');
    $routes->post('contentAlbum', 'BackendController::load_content_album');
    $routes->post('contentBook', 'BackendController::load_content_book');

    // Category management
    $routes->post('addCategory', 'BackendController::add_category');
    $routes->post('editCategoryModal/(:num)', 'BackendController::edit_category_modal/$1');
    $routes->post('editCategory/(:num)', 'BackendController::edit_category/$1');
    $routes->post('deleteCategory/(:num)', 'BackendController::delete_category/$1');

    // Activity management
    $routes->post('addActivity', 'BackendController::add_activity');
    $routes->post('editActivityModal/(:any)', 'BackendController::edit_activity_modal/$1');
    $routes->post('editActivity/(:any)', 'BackendController::edit_activity/$1');
    $routes->post('deleteActivity/(:any)', 'BackendController::delete_activity/$1');
    //Album Activity management
    $routes->post('addAlbumActivcity', 'BackendController::add_album_activcity');
    $routes->post('deleteAlbumActivcity/(:any)', 'BackendController::delete_album_activcity/$1');

    //Book Activity management
    $routes->post('approveBooking/(:any)', 'BackendController::approve_booking/$1');
    $routes->post('rejectBooking/(:any)', 'BackendController::reject_booking/$1');
});
