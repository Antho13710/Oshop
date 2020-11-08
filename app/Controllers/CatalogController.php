<?php
    
    namespace App\Controllers;

    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\Type;

class CatalogController extends CoreController
    {

        // page produit
        public function product($id)
        {
            $this->show('frontOffice/product', ['product' => Product::find($id)]);
        }

        // page produit par catégories
        public function category($id)
        {
            
            $this->show('frontOffice/products_list', ['current_sort' => Category::find($id), 'productsList' => Product::findAllBy($id, 'category_id')]);
        }

        // page produit par types
        public function type($id)
        {
            $this->show('frontOffice/products_list', ['current_sort' => Type::find($id), 'productsList' => Product::findAllBy($id, 'type_id')]);
        }

        // page produits par marques
        public function brand($id)
        {
            $this->show('frontOffice/products_list', ['current_sort' => Brand::find($id), 'productsList' => Product::findAllBy($id, 'brand_id')]);
        }
    }