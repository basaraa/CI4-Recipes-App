<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Recipes;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('recipes', [Recipes::class, 'index']);
$routes->get('recipes/(:segment)', [Recipes::class, 'showRecipeInfo']);
