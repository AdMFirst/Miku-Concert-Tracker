<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contribute', 'Contribute::index');
$routes->post('/contribute/save', 'Contribute::save');
$routes->post('/contribute/delete', 'Contribute::delete');

