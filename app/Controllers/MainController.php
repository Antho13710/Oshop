<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        
        
        return $this->show('backOffice/main/home', 
        [
            "productsListForHome" => Product::findLast(), 
            "categoryListForHome" => Category::findLast(),
            "brandsListForHome"   => Brand::findLast(),
            "typesListForHome"    => Type::findLast()
        ]);
    }

    public function oshopHome()
    {
        return $this->show('frontOffice/home', ["categories" => Category::findAllHomepage()]);
    }
    
    public function legalMentions()
    {
        $this->show('frontOffice/legal_mentions');
    }

}
