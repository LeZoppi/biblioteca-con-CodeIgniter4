<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


$routes->get('listar', 'Libros::index');
$routes->get('crear', 'Libros::crear');
$routes->post('guardar', 'Libros::guardar');
$routes->get('borrar/(:num)', 'Libros::borrar/$1');
$routes->get('editar/(:num)', 'Libros::editar/$1');
$routes->post('actualizar', 'Libros::actualizar');
$routes->get('buscar', 'Libros::buscar');