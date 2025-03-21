<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// LoginController & Logout
$routes->group('', ['filter' => 'logedin'], static function ($routes) {
    $routes->get('login', 'Login::index');
    $routes->post('login/validasi', 'Login::validasi');
});
$routes->get('logout', 'Login::logout');