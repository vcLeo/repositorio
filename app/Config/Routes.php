<?php

use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//rutas del login

$routes->get('login', 'LoginController::login');


$routes->get('dashboard', 'DashboardController::index');

// $routes->resource('usuarios', ['placeholder' => '(:num)', 'except' => 'show']);
/* $routes->get('usuarios', 'UsuariosController::index');
$routes->get('usuarios/new', 'UsuariosController::new');
$routes->post('usuarios', 'UsuariosController::create');
$routes->get('usuarios/(:num)/edit', 'UsuariosController::edit/$1');
$routes->put('usuarios/(:num)', 'UsuariosController::update/$1');
$routes->patch('usuarios/(:num)', 'UsuariosController::update/$1');
$routes->delete('usuarios/(:num)', 'UsuariosController::delete/$1'); */

//Datos personales de usuarios
$routes->resource('usuarios', ['placeholder' => '(:num)', 'except' => 'show']);


//roles para usuarios
$routes->resource('roles', ['placeholder' => '(:num)', 'except' => 'show']);

//programas
$routes->resource('programas', ['placeholder' => '(:num)', 'except' => 'show', 'except' => 'delete']);


//documentos
$routes->resource('documentos', ['placeholder' => '(:num)', 'except' => 'show']);


/* $routes->get('documentos', 'DocumentosController::index');
$routes->get('documentos/publicaciones', 'DocumentosController::publicar');
$routes->get('documentos/versiones', 'DocumentosController::versiones'); */

//autores
$routes->get('autores', 'AutoresController::index');
$routes->get('posgraduantes', 'AutoresController::posgraduante');


$routes->get('repositorios', 'RepositoriosController::index');
$routes->get('repositorios/programas', 'RepositoriosController::programas');
