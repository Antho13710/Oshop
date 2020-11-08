<?php
namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Category;

class CategoryController extends CoreController
{
    /**
     * Méthode permettant d'afficher la liste des catégories
     *
     * @return void
     */
    public function list()
    {
        

        return $this->show('backOffice/category/list', ["categoriesList" => Category::findAll()]);
    }

    /**
     * Méthode permettant d'afficher le formulaire d'ajout de catégorie
     *
     * @return void
     */
    public function add()
    {
        

        return $this->show('backOffice/category/add-modify');
    }

    /**
     * Méthode permettant d'afficher le formulaire de modification pour la catégorie demandée
     *
     * @param int $id : id de la catégorie
     * @return void
     */
    public function modify($id)
    {
        

        return $this->show('backOffice/category/add-modify', ["category" => Category::find($id)]);
    }

    /**
     * Méthode s'occupant du traitement du formulaire d'édition
     *
     * @return void
     */
    public function create()
    {

        $category = new Category();

        $category->setName(filter_input(INPUT_POST, 'name'));
        $category->setSubtitle(filter_input(INPUT_POST, 'subtitle'));
        $category->setPicture(filter_input(INPUT_POST, 'picture'));

        if($category->insert())
        {
            global $router;
            header("location: ".$router->generate('category-list'));
        }
        else
        {
            exit('ERROR');
        }
    }
    
    /**
     * Méthode s'occupant du traitement du formulaire de modification
     *
     * @param int $id : id de la catégorie
     * @return void
     */
    public function update($id)
    {

        $category = Category::find($id);

        // TODO amélio : Vérif que la catégorie existe
        if($category === false)
        {
            global $router;
            header('location: '.$router->generate('404'));
        }

        // TODO : vérif les valeurs avec filter_input

        $category->setName(filter_input(INPUT_POST, 'name'));
        $category->setSubtitle(filter_input(INPUT_POST, 'subtitle'));
        $category->setPicture(filter_input(INPUT_POST, 'picture'));

        if($category->update())
        {
            global $router;
            header("location: ".$router->generate('category-modify', ['category_id' => $id]));
        }
        else
        {
            exit('ERROR');
        }
    }

    /**
     * Méthode s'ocupant du traitement de la suppression d'une catégorie
     *
     * @param int $id : id de la catégorie
     * @return void
     */
    public function delete($id)
    {
        
        $category = Category::find($id);

        if($category->delete())
        {
            global $router;
            header("location: ".$router->generate('category-list'));
        }
        else
        {
            exit('ERROR');
        }
    }
}