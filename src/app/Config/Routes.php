<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Recipes;
use App\Controllers\Users;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('recipes', [Recipes::class, 'index']);
$routes->get('recipes/newRecipe', [Recipes::class, 'newRecipe']);
$routes->post('recipes', [Recipes::class, 'createRecipe']);
$routes->get('recipes/(:segment)', [Recipes::class, 'showRecipeInfo']);
$routes->get('users/recipes/(:segment)', [Recipes::class, 'index']);
$routes->get('users/myrecipes', [Recipes::class, 'loggedUserRecipes'],['filter' => 'authFilter']);
$routes->get('users/list', [Users::class, 'userList']);
$routes->get('users', [Users::class, 'index'],['filter' => 'authFilter']);
$routes->get('users/register', [Users::class, 'index'],['filter' => 'guestFilter']);
$routes->post('users/register', [Users::class, 'register'],['filter' => 'guestFilter']);
$routes->get('users/login', [Users::class, 'loginForm'],['filter' => 'authFilter']);
$routes->post('users/login', [Users::class, 'login'],['filter' => 'authFilter']);
$routes->get('users/logout', [Users::class, 'logout'],['filter' => 'authFilter']);
$routes->post('recipeEditForm', [AjaxHandler::class, 'index']);
$routes->post('recipeEdit', [AjaxHandler::class, 'editRecipe']);
$routes->post('recipeDelete', [AjaxHandler::class, 'deleteRecipe']);
