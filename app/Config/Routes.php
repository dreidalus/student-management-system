<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Authorize::login');

 $routes->group('courses', function($routes) {
    $routes->get('/', 'Courses::index');                    
    $routes->get('add', 'Courses::add');                     
    $routes->post('store', 'Courses::store');
    $routes->get('edit/(:num)', 'Courses::edit/$1');     
    $routes->post('update/(:num)', 'Courses::update/$1');     
    $routes->get('delete/(:num)', 'Courses::delete/$1');
    $routes->get('courses/delete/(:num)', 'Courses::delete/$1');

});

$routes->group('students', function($routes) {
    $routes->get('/', 'Students::index');                      // Show all index
    $routes->get('add', 'Students::add');                      // Show add form
    $routes->post('store', 'Students::store');                 // Handle add form submission
    $routes->get('edit/(:num)', 'Students::edit/$1');          // Show edit form
    $routes->post('update/(:num)', 'Students::update/$1');     // Handle edit form submission
    $routes->get('delete/(:num)', 'Students::delete/$1');      // Delete data
});

$routes->group('attendance', function($routes) {
    $routes->get('/', 'Attendance::index');
    $routes->get('add', 'Attendance::add');
    $routes->post('store', 'Attendance::store');
    $routes->get('edit/(:num)', 'Attendance::edit/$1');
    $routes->post('update/(:num)', 'Attendance::update/$1');
    $routes->get('delete/(:num)', 'Attendance::delete/$1');
});

$routes->group('grades', function($routes) {
    $routes->get('/', 'Grades::index');
    $routes->get('add', 'Grades::add');
    $routes->post('store', 'Grades::store');
    $routes->get('edit/(:num)', 'Grades::edit/$1');
    $routes->post('update/(:num)', 'Grades::update/$1');
    $routes->get('delete/(:num)', 'Grades::delete/$1');
});

$routes->group('auth', function($routes) {
    $routes->get('log_in', 'Authorize::login');
    $routes->post('log_in', 'Authorize::loginPost');
    $routes->get('logout', 'Authorize::logout');
});

$routes->group('authorize', function($routes) {
$routes->get('login', 'Authorize::login');
$routes->post('login', 'Authorize::loginPost');
$routes->get('register', 'Authorize::register');
$routes->post('register', 'Authorize::registerPost');
$routes->get('logout', 'Authorize::logout');

});

$routes->group('', ['filter' => 'auth'], function($routes) {
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/index', 'Dashboard::index');

});











