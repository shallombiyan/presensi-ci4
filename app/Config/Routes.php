<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

$routes->get ('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get ('admin/jabatan', 'Admin\Jabatan::index', ['filter' => 'adminFilter']);
$routes->get ('admin/jabatan/create', 'Admin\Jabatan::create', ['filter' => 'adminFilter']);
$routes->get ('admin/jabatan/store', 'Admin\Jabatan::store', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/edit/(:segment)', 'Admin\Jabatan :: edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/jabatan/update/(:segment)', 'Admin\Jabatan :: update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/jabatan/delete/(:segment)', 'Admin\Jabatan :: delete/$1', ['filter' => 'adminFilter']);




$routes->get ('pegawai/home', 'Pegawai\Home::index', ['filter' => 'pegawaiFilter']);