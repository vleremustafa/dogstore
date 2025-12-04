<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('index', ['controller' => 'HomeController', 'action' => 'index']);
// $router->add('form', ['controller' => 'HomeController', 'action' => 'form']);
$router->add('addacc',['controller' => 'HomeController', 'action' => 'creatacc']);
// $router->add('add_to_bag',['controller' => 'CartController', 'action' => 'addtoBag'])
// $router->add('GET', 'index.php?action=add_to_bag&outfit_id={outfit_id}', ['controller' => 'CartController', 'action' => 'addtoBag']);;
$router->add('GET', 'outfit_id={{ outfit.id }}', ['controller' => 'CartController', 'action' => 'addtoBag( outfit.id)']);
$router->add('carta', ['controller' => 'OutfitController', 'action' => 'editOutfit']);

// $router->add('getId', ['controller' => 'OutfitController', 'action' => 'getId']);
$router->add('getId', ['controller' => 'OutfitController', 'action' => 'getId']);

// $router->add('outfits-editid', ['controller' => 'OutfitController', 'action' => 'editOutfit']);

// $router->add('GET', 'cart', ['controller' => 'App\Controllers\CartController', 'action' => 'cart']);

$router->add('login-form', ['controller' => 'AuthController', 'action' => 'loginForm']);
$router->add('login-store', ['controller' => 'AuthController', 'action' => 'loginStore']);
$router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

$router->add('categories', ['controller' => 'CategoryController', 'action' => 'index']);
$router->add('categories-create', ['controller' => 'CategoryController', 'action' => 'create']);
$router->add('categories-store', ['controller' => 'CategoryController', 'action' => 'store']);
$router->add('categories-edit', ['controller' => 'CategoryController', 'action' => 'edit']);
$router->add('categories-update', ['controller' => 'CategoryController', 'action' => 'update']);
$router->add('categories-delete', ['controller' => 'CategoryController', 'action' => 'destroy']);

$router->add('costumers',['controller' => 'CostumerController', 'action' => 'index']);
$router->add('costumers-create', ['controller' => 'CostumerController', 'action' => 'create']);
$router->add('costumers-store', ['controller' => 'CostumerController', 'action' => 'store']);
$router->add('costumers-edit', ['controller' => 'CostumerController', 'action' => 'edit']);
$router->add('costumers-update', ['controller' => 'CostumerController', 'action' => 'update']);
$router->add('costumers-delete', ['controller' => 'CostumerController', 'action' => 'destroy']);

$router->add('workers',['controller' => 'WorkerController', 'action' => 'index']);
$router->add('workers-create', ['controller' => 'WorkerController', 'action' => 'create']);
$router->add('workers-store', ['controller' => 'WorkerController', 'action' => 'store']);
$router->add('workers-edit', ['controller' => 'WorkerController', 'action' => 'edit']);
$router->add('workers-update', ['controller' => 'WorkerController', 'action' => 'update']);
$router->add('workers-delete', ['controller' => 'WorkerController', 'action' => 'destroy']);

$router->add('outfits',['controller' => 'OutfitController', 'action' => 'index']);
$router->add('outfits-create', ['controller' => 'OutfitController', 'action' => 'create']);
$router->add('outfits-store', ['controller' => 'OutfitController', 'action' => 'store']);
$router->add('outfits-edit', ['controller' => 'OutfitController', 'action' => 'edit']);
$router->add('outfits-update', ['controller' => 'OutfitController', 'action' => 'update']);
$router->add('outfits-delete', ['controller' => 'OutfitController', 'action' => 'destroy']);

$router->add('orders',['controller' => 'OrderController', 'action' => 'index']);
$router->add('orders-create', ['controller' => 'OrderController', 'action' => 'create']);
$router->add('orders-store', ['controller' => 'OrderController', 'action' => 'store']);
$router->add('orders-edit', ['controller' => 'OrderController', 'action' => 'edit']);
$router->add('orders-update', ['controller' => 'OrderController', 'action' => 'update']);
$router->add('orders-delete', ['controller' => 'OrderController', 'action' => 'destroy']);



$router->dispatch($_SERVER['QUERY_STRING']);


?>