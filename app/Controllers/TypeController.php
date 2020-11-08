<?php
    
    namespace App\Controllers;

    use App\Models\Type;

    class TypeController extends CoreController
    {
        /**
         * Méthode permettant d'afficher la liste des types
         * @return void
         */
        public function list()
        {
            return $this->show('backOffice/type/list', ["typesList" => Type::findAll()]);
        }

        /**
         * Méthode permettant d'afficher le formulaire d'ajout
         * @return void
         */
        public function add()
        {
            return $this->show('backOffice/type/add-modify');
        }

        /**
         * Méthode permettant d'afficher le formulaire de modification
         * @param int $id
         * @return void
         */
        public function modify($id)
        {
            return $this->show('backOffice/type/add-modify', ["type" => Type::find($id)]);
        }

        /**
         * Méthode permettant le traitement du formulaire d'ajout
         * @return void
         */
        public function create()
        {

            $type = new Type();
    
            $type->setName(filter_input(INPUT_POST, 'name'));
            $type->setFooterOrder(filter_input(INPUT_POST, 'footerOrder'));
    
            if($type->insert())
            {
                global $router;
                header("location: ".$router->generate('type-list'));
            }
            else
            {
                exit('ERROR');
            }
        }
    
        /**
         * Méthode permettant le traitement du formulaire de modification
         * @param int $id
         * @return void
         */
        public function update($id)
        {

            $type = Type::find($id);
    
            $type->setName(filter_input(INPUT_POST, 'name'));
            $type->setFooterOrder(filter_input(INPUT_POST, 'footerOrder'));
    
            if($type->update())
            {
                global $router;
                header("location: ".$router->generate('type-modify', ['type_id' => $id]));
            }
            else
            {
                exit('ERROR');
            }
        }
    
        /**
         * Méthode permettant le traitement de la suppression
         * @param int $id
         * @return void
         */
        public function delete($id)
        {
            
            $type = Type::find($id);
    
            if($type->delete())
            {
                global $router;
                header("location: ".$router->generate('type-list'));
            }
            else
            {
                exit('ERROR');
            }
        }
    }