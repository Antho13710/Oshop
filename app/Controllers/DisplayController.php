<?php
    
    namespace App\Controllers;

    use App\Models\Category;

class DisplayController extends CoreController
    {
        /**
         * Méthode permettant d'afficher le formulaire de modification de l'ordre des catégories sur la home page de Oshop
         * @return void
         */ 
        public function modify()
        {
            return $this->show('backOffice/display/home-selection', ["categories" => Category::findAll()]);
        }

        /**
         * Méthode permettant le traitement du formulaire de modification
         * @return void
         */
        public function update()
        {
            if(count($_POST['location']) !== 5)
            {
                return false; // 
                echo 'nombre de catégories incorrect';
                exit;
            }

            if(count(array_unique($_POST['location'])) !== 5)
            {
                return false; // 
                echo 'Catégories en double';
                exit;
            }

            // $order = $_POST['location'];
            // Category::resetHomeOrder();

            // foreach($order as $index => $category)
            // {
            //     $update = Category::find($category);
            //     $update->setHomeOrder($index + 1);
            //     $update->updateHomeOrder();
            // }

            // méthode de la correction
            $categories = Category::findAll();

            foreach($categories as $category)
            {
                $home_order = array_keys($_POST['location'], $category->getId());

                // $home_order = la valeur du tableau et si il est vide 0
                $home_order = $home_order[0] ?? 0;
                    
                $category->setHomeOrder($home_order);
                $category->update();
            }

            global $router;
            header('Location: '.$router->generate('display-modify'));
        }
    }