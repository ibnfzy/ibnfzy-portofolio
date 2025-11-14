<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public site
$routes->get('/', 'PublicController::index');

// Admin area - grouped under namespace App\Controllers\Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes){
	$routes->get('/', 'Dashboard::index');
	// Example admin sub-routes (controllers to be created as needed)
	$routes->get('projects', 'Projects::index');
	// Auth routes for admin
	$routes->get('auth/login', 'Auth::login');
	$routes->post('auth/attempt', 'Auth::attempt');
	$routes->get('auth/logout', 'Auth::logout');
	$routes->get('projects/create', 'Projects::create');
	$routes->post('projects/store', 'Projects::store');
	$routes->get('projects/edit/(:num)', 'Projects::edit/$1');
	$routes->post('projects/update/(:num)', 'Projects::update/$1');
	$routes->get('projects/delete/(:num)', 'Projects::delete/$1');
	$routes->post('projects/upload/(:num)', 'Projects::upload/$1');
	$routes->post('projects/(:num)/reorder-images', 'Projects::reorderImages/$1');
	$routes->get('projects/delete-image/(:num)', 'Projects::deleteImage/$1');
	$routes->get('articles', 'Articles::index');
	$routes->get('articles/create', 'Articles::create');
	$routes->post('articles/store', 'Articles::store');
	$routes->get('articles/edit/(:num)', 'Articles::edit/$1');
	$routes->post('articles/update/(:num)', 'Articles::update/$1');
	$routes->get('articles/delete/(:num)', 'Articles::delete/$1');
	$routes->post('articles/upload/(:num)', 'Articles::upload/$1');
	$routes->post('articles/(:num)/reorder-images', 'Articles::reorderImages/$1');
	$routes->get('articles/delete-image/(:num)', 'Articles::deleteImage/$1');
	$routes->get('articles/(:num)/images', 'Articles::images/$1');
	$routes->delete('articles/(:num)/image/(:num)/delete', 'Articles::imageDelete/$1/$2');
	$routes->get('profile', 'Profile::index');
	$routes->get('profile/form', 'Profile::form');
	$routes->post('profile/update', 'Profile::update');
	$routes->get('users', 'Users::index');
	$routes->get('users/create', 'Users::create');
	$routes->post('users/store', 'Users::store');
});

// Keep the default Home route as a fallback
$routes->get('home', 'Home::index');

// Public project/article routes
$routes->get('projects', 'PublicController::projects');
$routes->get('projects/(:segment)', 'PublicController::project/$1');
$routes->get('project/(:num)/image/(:num)', 'PublicController::projectImage/$1/$2');

$routes->get('articles', 'PublicController::articles');
$routes->get('articles/(:segment)', 'PublicController::article/$1');
