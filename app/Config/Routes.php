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
$routes->get($baseSubURL.'/', 'HomeController::index');


$routes->get($baseSubURL. '/backend', 'BackendController::index');
$routes->get($baseSubURL. '/backend/dashboard', 'BackendController::dashboard');
$routes->post($baseSubURL. '/backend/contentUser', 'BackendController::load_content_user');
$routes->post($baseSubURL. '/backend/contentCategory', 'BackendController::load_content_category');
$routes->post($baseSubURL. '/backend/contentActivity', 'BackendController::load_content_activity');
$routes->post($baseSubURL. '/backend/addCategory', 'BackendController::add_category');
$routes->post($baseSubURL. '/backend/editCategoryModal/(:num)', 'BackendController::edit_category_modal/$1');
$routes->post($baseSubURL. '/backend/editCategory/(:num)', 'BackendController::edit_category/$1');
$routes->post($baseSubURL. '/backend/deleteCategory/(:num)', 'BackendController::delete_category/$1');
$routes->post($baseSubURL. '/backend/addActivity/', 'BackendController::add_activity');
$routes->post($baseSubURL. '/backend/deleteActivity/(:any)', 'BackendController::delete_activity/$1');
