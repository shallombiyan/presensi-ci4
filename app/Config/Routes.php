<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

$routes->get ('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get ('pegawai/home', 'Pegawai\Home::index');