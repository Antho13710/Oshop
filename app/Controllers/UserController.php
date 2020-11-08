<?php
    
    namespace App\Controllers;

    use App\Models\AppUser;

class UserController extends CoreController
    {
        /**
         * Méthode permettant d'afficher le formulaire de connexion
         * @return void
         */
        public function login()
        {
            return $this->show('backOffice/user/login');
        }

        /**
         * Méthode permettant de traiter le formulaire de connexion 
         * @return void
         */
        public function connect()
        {
            global $router;
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            $errorList = [];

            $user = AppUser::findByEmail($email);

            if($user && password_verify($password, $user->getPassword()))
            {
                $_SESSION['connectedUser'] = $user;

                header("Location: ".$router->generate('main-home'));
            }
            else
            {
                $errorList[] = 'erreur utilisateur ou mot de passe invalide';
                $this->show('user/login', ["errorList" => $errorList]);
            }
        }

        /**
         * Méthode permettant la déconnexion
         * @return void
         */
        public function logout()
        {
            global $router;
            unset($_SESSION['connectedUser']);

            header("Location: ".$router->generate('user-login'));
        }

        /**
         * Méthode permettant d'afficher la liste des utilisateurs
         * @return void
         */
        public function list()
        {
            return $this->show('backOffice/user/list', ['users' => AppUser::findAll()]);
        }

        /**
         * Méthode permettant d'afficher le formulaire d'ajout d'utilisateur
         * @return void
         */
        public function add()
        {
            return $this->show('backOffice/user/add-modify');
        }

        /**
         * Méthode permettant le traitement du formulaire d'ajout d'utilisateur
         * @return void
         */
        public function create()
        {
            if(!empty($_POST))
            {
                if( $_POST['password'] !== $_POST['confirm'] ) 
                {
                    return $this->show('backOffice/user/add-modify', ['error' => "Les mots de passes ne correspondent pas"]);
                }

                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $password = filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[\_\-\|\%\&\*\=\@\$]).{8}/']]);
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $role = $_POST['role'];
                $status = $_POST['status'];

                if($email !== false && $password !== false && $firstname !== '' && $lastname !== '' && $role !== '' && $status !== '')
                {
                    $user = new AppUser();

                    $user->setEmail($email);
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                    $user->setFirstname($firstname);
                    $user->setLastname($lastname);
                    $user->setRole($role);
                    $user->setStatus($status);

                    if($user->insert())
                    {
                        global $router;
                        header("location: ".$router->generate('user-list'));
                    }
                    else
                    {
                        exit('Une Erreur est survenue');
                    }
                    
                }
                else
                {
                    return $this->show('backOffice/user/add-modify', ['error' => "Erreur, tous les champs doivent être remplis et le mot de passe doit contenir
                        au moins : 8 caractères dont 1 minuscule, 1 majuscule,1 chiffre et 1 caractère spécial parmi ['_', '-', '|', '%', '&', '*', '=', '@', '$'] "]);
                }
            }
        }

        /**
         * Méthode permettant d'afficher le formulaire de modification d'un utilisateur
         * @param int $id : id de l'utilisateur
         * @return void
         */
        public function modify($id)
        {
            return $this->show('backOffice/user/add-modify', ["user" => AppUser::find($id)]);
        }

        /**
         * Méthode s'occupant du traitement du formulaire de modification
         * @param int $id : id de l'utilisateur
         * @return void
         */
        public function update($id)
        {
            if( $_POST['password'] !== $_POST['confirm'] ) 
            {
                return $this->show('backOffice/user/add-modify', ["user" => AppUser::find($id), 'error' => "Les mots de passes ne correspondent pas"]);
            }

            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[\_\-\|\%\&\*\=\@\$]).{8}/']]);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $role = $_POST['role'];
            $status = $_POST['status'];

            if($email !== false && $password !== false && $firstname !== '' && $lastname !== '' && $role !== '' && $status !== '')
            {
                $user = AppUser::find($id);

                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setRole($role);
                $user->setStatus($status);

                if($user->update())
                {
                    global $router;
                    header("location: ".$router->generate('user-modify', ['user_id' => $id]));
                }
                else
                {
                    exit('Une Erreur est survenue');
                }
                
            }
            else
            {
                return $this->show('backOffice/user/add-modify', ["user" => AppUser::find($id), 'error' => "Erreur, tous les champs doivent être remplis et le mot de passe doit contenir
                    au moins : 8 caractères dont 1 minuscule, 1 majuscule,1 chiffre et 1 caractère spécial parmi ['_', '-', '|', '%', '&', '*', '=', '@', '$'] "]);
            }
        }

        /**
         * Méthode s'ocupant du traitement de la suppression d'un utilisateur
         * @param int $id : id de l'utilisateur'
         * @return void
         */
        public function delete($id)
        {
            
            $user = AppUser::find($id);

            if($user->delete())
            {
                global $router;
                header("location: ".$router->generate('user-list'));
            }
            else
            {
                exit('ERROR');
            }
        }
    }