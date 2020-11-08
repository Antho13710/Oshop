<?php
    
    namespace App\Controllers;

    use App\Models\Brand;

class BrandController extends CoreController
    {
        /**
         * Méthode permettant d'afficher la liste des marques
         * @return void
         */
        public function list()
        {
            return $this->show('backOffice/brand/list', ["brandsList" => Brand::findAll()]);
        }

        /**
         * Méthode permettant d'afficher le formulaire d'ajout de marque
         * @return void
         */
        public function add()
        {
            return $this->show('backOffice/brand/add-modify', []);
        }
    
        /**
         * Méthode permettant d'afficher le formulaire de modification d'une marque
         * @param int $id
         * @return void
         */
        public function modify($id)
        {   
            return $this->show('backOffice/brand/add-modify', ["brand" => Brand::find($id)]);
        }

        /**
         * Méthode permettant le traitement du formulaire d'ajout de marque
         * @return void
         */
        public function create()
        {
    
            $brand = new Brand();
    
            $brand->setName(filter_input(INPUT_POST, 'name'));
            $brand->setFooterOrder(filter_input(INPUT_POST, 'footerOrder'));
    
            if($brand->insert())
            {
                global $router;
                header("location: ".$router->generate('brand-list'));
            }
            else
            {
                exit('ERROR');
            }
        }
    
        /**
         * Méthode permettant le traitement du formulaire de modification d'une marque
         * @param int $id : id de la marque
         * @return void
         */
        public function update($id)
        {
    
            $brand = Brand::find($id);
    
            $brand->setName(filter_input(INPUT_POST, 'name'));
            $brand->setFooterOrder(filter_input(INPUT_POST, 'footerOrder'));
    
            if($brand->update())
            {
                global $router;
                header("location: ".$router->generate('brand-modify', ['brand_id' => $id]));
            }
            else
            {
                exit('ERROR');
            }
        }
    
        /**
         * Méthode permettant le traitement de la supression d'une marque
         * @param int $id : id de la marque
         * @return void
         */
        public function delete($id)
        {
            $brand = Brand::find($id);
    
            if($brand->delete())
            {
                global $router;
                header("location: ".$router->generate('brand-list'));
            }
            else
            {
                exit('ERROR');
            }
        }
    }