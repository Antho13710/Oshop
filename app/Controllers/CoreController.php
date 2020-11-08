<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Type;

abstract class CoreController 
{

    public function __construct()
    {
        global $match;
        $currentRouteName = $match['name'];

        $acl = [
            //'user-login'    => PUBLIC
            //'user-logout'   => USERS CONNECTED
            'main-home'       => ['admin', 'catalog-manager'],
            'user-list'       => ['admin'],            
            'user-add'        => ['admin'],            
            'user-create'     => ['admin'],            
            'user-modify'     => ['admin'],            
            'user-update'     => ['admin'],            
            'user-delete'     => ['admin'],
            'category-list'   => ['admin', 'catalog-manager'],
            'category-add'    => ['admin', 'catalog-manager'],
            'category-create' => ['admin', 'catalog-manager'],
            'category-modify' => ['admin', 'catalog-manager'],
            'category-update' => ['admin', 'catalog-manager'],
            'category-delete' => ['admin', 'catalog-manager'],
            'product-list'    => ['admin', 'catalog-manager'],
            'product-add'     => ['admin', 'catalog-manager'],
            'product-create'  => ['admin', 'catalog-manager'],
            'product-modify'  => ['admin', 'catalog-manager'],
            'product-update'  => ['admin', 'catalog-manager'],
            'product-delete'  => ['admin', 'catalog-manager'],
            'brand-list'      => ['admin', 'catalog-manager'],
            'brand-add'       => ['admin', 'catalog-manager'],
            'brand-create'    => ['admin', 'catalog-manager'],
            'brand-modify'    => ['admin', 'catalog-manager'],
            'brand-update'    => ['admin', 'catalog-manager'],
            'brand-delete'    => ['admin', 'catalog-manager'],
            'type-list'       => ['admin', 'catalog-manager'],
            'type-add'        => ['admin', 'catalog-manager'],
            'type-create'     => ['admin', 'catalog-manager'],
            'type-modify'     => ['admin', 'catalog-manager'],
            'type-update'     => ['admin', 'catalog-manager'],
            'type-delete'     => ['admin', 'catalog-manager'],
            'display-modify'  => ['admin', 'catalog-manager'],
            'display-update'  => ['admin', 'catalog-manager']
        ];

        if(array_key_exists( $currentRouteName, $acl))
        {
            $this->checkAuthorization($acl[$currentRouteName]);
        }

        // Ajout check token anti-CSRF en POST
        $csrfTokenToCheckInPost = [
            'display-update',
            'category-create',
            'category-update',
            'brand-create',
            'brand-update',
            'product-create',
            'product-update',
            'type-create',
            'type-update',
            'user-create',
            'user-update',
        ];

        // Si la route actuelle nécessite la vérification d'un token anti-CSRF
        if (in_array($currentRouteName, $csrfTokenToCheckInPost)) {
            // On récupère le token en POST
            $token = isset($_POST['token']) ? $_POST['token'] : '';

            // On récupère le token en SESSION
            $sessionToken = $_SESSION['token'] ?? '';

            // S'ils ne sont pas égaux ou vide
            if ($token !== $sessionToken || empty($token)) {
                // Alors on affiche une 403
                ErrorController::err403();
            }
            // Sinon, tout va bien
            else {
                // On supprime le token en session
                // Ainsi, on ne pourra pas soumettre plusieurs fois le même formulaire, ni réutiliser ce token
                unset($_SESSION['token']);
            }
        }

        // Ajout check token anti-CSRF en GET
        $csrfTokenToCheckInGet = [
            'category-delete',
            'brand-delete',
            'product-delete',
            'type-delete',
            'user-delete',
        ];

        if (in_array($currentRouteName, $csrfTokenToCheckInGet))
        {
            $token = isset($_GET['token']) ? $_GET['token'] : '';

            $sessionToken = $_SESSION['token'] ?? '';
            
            if ($token !== $sessionToken || empty($token)) {

                ErrorController::err403();
            }
            else
            {
                unset($_SESSION['token']);
            }
        }

 
        $_SESSION['token'] = bin2hex(random_bytes(64));
    }

    /**
     * Méthode permettant de vérifier les droits d'accès
     * @param array $roles
     * @return void
     */
    public function checkAuthorization($roles = [])
    {
        if(isset($_SESSION['connectedUser']))
        {
            $userRole = $_SESSION['connectedUser']->getRole();

            if(in_array($userRole, $roles))
            {
                return;
            }
            else
            {
                ErrorController::err403();
            }
        }
        else
        {
            global $router;
            header('Location: '.$router->generate('user-login'));
            exit();
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        $viewVars['typesFooter'] = Type::findAllFooter();
        $viewVars['brandsFooter'] = Brand::findAllFooter();

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
}
