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
$routes->post($baseSubURL. '/backend/addCategory', 'BackendController::add_category');