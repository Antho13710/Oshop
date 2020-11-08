<?php
namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController
{
    /**
     * Méthode permettant d'afficher la liste des produits
     * @return void
     */
    public function list()
    {
        return $this->show('backOffice/product/list', ["productsList" => Product::findAll(), ]);
    }

    /**
     * Méthode permettant d'afficher le formulaire d'ajout de produit
     * @return void
     */
    public function add()
    {
        

        return $this->show('backOffice/product/add-modify', ["category" =>Category::findAll(), "brands" => Brand::findAll(), "types" => Type::findAll(), ]);
    }

    /**
     * Méthode permettant d'afficher le formulaire de modification d'un produit
     * @param int $id : id du produit
     * @return void
     */
    public function modify($id)
    {   
        return $this->show('backOffice/product/add-modify', ["product" => Product::find($id), "category" =>Category::findAll(), "brands" => Brand::findAll(), "types" => Type::findAll(), ]);
    }

    /**
     * Méthode permettant le traitement du formulaire d'ajout d'un produit
     * @return void
     */
    public function create()
    {

        $product = new Product();

        $product->setName(filter_input(INPUT_POST, 'name'));
        $product->setDescription(filter_input(INPUT_POST, 'description'));
        $product->setPicture(filter_input(INPUT_POST, 'picture'));
        $product->setPrice(filter_input(INPUT_POST, 'price'));
        $product->setRate(filter_input(INPUT_POST, 'rate'));
        $product->setStatus(filter_input(INPUT_POST, 'status'));
        $product->setCategoryId(filter_input(INPUT_POST, 'category_id'));
        $product->setBrandId(filter_input(INPUT_POST, 'brand_id'));
        $product->setTypeId(filter_input(INPUT_POST, 'type_id'));

        if($product->insert())
        {
            global $router;
            header("location: ".$router->generate('product-list'));
        }
        else
        {
            
        }
    }

    /**
     * Méthode permettant le traitement du formulaire de modification
     * @param int $id
     * @return void
     */
    public function update($id)
    {

        $product = Product::find($id);

        $product->setName(filter_input(INPUT_POST, 'name'));
        $product->setDescription(filter_input(INPUT_POST, 'description'));
        $product->setPicture(filter_input(INPUT_POST, 'picture'));
        $product->setPrice(filter_input(INPUT_POST, 'price'));
        $product->setRate(filter_input(INPUT_POST, 'rate'));
        $product->setStatus(filter_input(INPUT_POST, 'status'));
        $product->setCategoryId(filter_input(INPUT_POST, 'category_id'));
        $product->setBrandId(filter_input(INPUT_POST, 'brand_id'));
        $product->setTypeId(filter_input(INPUT_POST, 'type_id'));

        if($product->update())
        {
            global $router;
            header("location: ".$router->generate('product-modify', ['product_id' => $id]));
        }
        else
        {
            exit('ERROR');
        }
    }

    /**
     * Méthode permettant le traitement de la suppression d'un produit
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        
        $product = Product::find($id);

        if($product->delete())
        {
            global $router;
            header("location: ".$router->generate('product-list'));
        }
        else
        {
            exit('ERROR');
        }
    }
}