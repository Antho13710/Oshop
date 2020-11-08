<?php

// POINT D'ENTRÉE UNIQUE : 
// FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';

session_start();

/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"

/*********************************************************************************************************************************************************************
 * ROUTES CLIENT
 *********************************************************************************************************************************************************************/

// home page
$router->map('GET', '/', '\App\Controllers\MainController::oshopHome', 'oshop-main-home');

// page mentions légales
$router->map('GET','/legal-mentions', '\App\Controllers\MainController::legalMentions', 'oshop-main-legal-mentions');

// page produit
$router->map('GET', '/catalog/product/[i:product_id]', '\App\Controllers\CatalogController::product', 'oshop-catalog-product');

// page produit par catégories
$router->map('GET', '/catalog/category/[i:category_id]', '\App\Controllers\CatalogController::category', 'oshop-catalog-category'); 

// page produit par type
$router->map('GET', '/catalog/type/[i:type_id]', '\App\Controllers\CatalogController::type', 'oshop-catalog-type');

// page produit par marque
$router->map('GET', '/catalog/brand/[i:brand_id]', '\App\Controllers\CatalogController::brand', 'oshop-catalog-brand');


/*********************************************************************************************************************************************************************
 * ROUTES BACK OFFICE
 *********************************************************************************************************************************************************************/

// route: Accueil
$router->map('GET', '/home', '\App\Controllers\MainController::home', 'main-home');

// routes: User
$router->map('GET', '/user/login', '\App\Controllers\UserController::login', 'user-login');
$router->map('POST', '/user/login', '\App\Controllers\UserController::connect', 'user-connect');

$router->map('GET', '/user/logout', '\App\Controllers\UserController::logout', 'user-logout');

$router->map('GET', '/user/list', '\App\Controllers\UserController::list', 'user-list');

$router->map('GET', '/user/add', '\App\Controllers\UserController::add', 'user-add');
$router->map('POST', '/user/add', '\App\Controllers\UserController::create', 'user-create');

$router->map('GET', '/user/modify/[i:user_id]', '\App\Controllers\UserController::modify', 'user-modify');
$router->map('POST', '/user/modify/[i:user_id]', '\App\Controllers\UserController::update', 'user-update');

$router->map('GET', '/user/delete/[i:user_id]', '\App\Controllers\UserController::delete', 'user-delete');

// routes: Catégories
$router->map('GET', '/category/list', '\App\Controllers\CategoryController::list', 'category-list');

$router->map('GET', '/category/add', '\App\Controllers\CategoryController::add', 'category-add');
$router->map('POST', '/category/add', '\App\Controllers\CategoryController::create', 'category-create');

$router->map('GET', '/category/modify/[i:category_id]', '\App\Controllers\CategoryController::modify', 'category-modify');
$router->map('POST', '/category/modify/[i:category_id]', '\App\Controllers\CategoryController::update', 'category-update');

$router->map('GET', '/category/delete/[i:category_id]', '\App\Controllers\CategoryController::delete', 'category-delete');

// routes: Produits
$router->map('GET', '/product/list', '\App\Controllers\ProductController::list', 'product-list');

$router->map('GET', '/product/add', '\App\Controllers\ProductController::add', 'product-add');
$router->map('POST', '/product/add', '\App\Controllers\ProductController::create', 'product-create');

$router->map('GET', '/product/modify/[i:product_id]', '\App\Controllers\ProductController::modify', 'product-modify');
$router->map('POST', '/product/modify/[i:product_id]', '\App\Controllers\ProductController::update', 'product-update');

$router->map('GET', '/product/delete/[i:product_id]', '\App\Controllers\ProductController::delete', 'product-delete');

// routes: Marques
$router->map('GET', '/brand/list', '\App\Controllers\BrandController::list', 'brand-list');

$router->map('GET', '/brand/add', '\App\Controllers\BrandController::add', 'brand-add');
$router->map('POST', '/brand/add', '\App\Controllers\BrandController::create', 'brand-create');

$router->map('GET', '/brand/modify/[i:brand_id]', '\App\Controllers\BrandController::modify', 'brand-modify');
$router->map('POST', '/brand/modify/[i:brand_id]', '\App\Controllers\BrandController::update', 'brand-update');

$router->map('GET', '/brand/delete/[i:brand_id]', '\App\Controllers\BrandController::delete', 'brand-delete');

// routes: Types
$router->map('GET', '/type/list', '\App\Controllers\TypeController::list', 'type-list');

$router->map('GET', '/type/add', '\App\Controllers\TypeController::add', 'type-add');
$router->map('POST', '/type/add', '\App\Controllers\TypeController::create', 'type-create');

$router->map('GET', '/type/modify/[i:type_id]', '\App\Controllers\TypeController::modify', 'type-modify');
$router->map('POST', '/type/modify/[i:type_id]', '\App\Controllers\TypeController::update', 'type-update');

$router->map('GET', '/type/delete/[i:type_id]', '\App\Controllers\TypeController::delete', 'type-delete');

// routes : Séléctions Accueil et Footer
$router->map('GET', '/display', '\App\Controllers\DisplayController::modify', 'display-modify');
$router->map('POST', '/display', '\App\Controllers\DisplayController::update', 'display-update');


/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
