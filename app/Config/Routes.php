<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/serp', 'Home::serp');
$routes->get('/rqur', 'Home::rqur');
