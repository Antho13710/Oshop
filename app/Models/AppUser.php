<?php

namespace App\Models;

use App\Models\CoreModel;
use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $role;    // 'admin' | 'catalog-manager'
    protected $status; // 1 = actif | 2 = inactif/bloqué
    
    /**
     * Méthode permettant de récupérer un utilisateur en bdd
     * @param int $id
     * @return AppUser
     */
    public static function find($id) 
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `app_user` WHERE `id` =' . $id;

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject(__CLASS__);
    }

    /**
     * Méthode permettant de récupérer tous les utilisateurs en bdd
     * @return AppUser
     */
    public static function findAll() 
    {
        $pdo = Database::getPDO();

        $sql = " SELECT * FROM `app_user` ";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Méthode permettant de récupérer un utilisateur par rapport à son adresse mail
     * @param string $email
     * @return AppUser
     */
    public static function findByEmail(string $email)
    {
        $pdo = Database::getPDO();

        $sql = "
                SELECT *
                FROM `app_user`
                WHERE `email` = :email
        ";

        $query = $pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchObject('App\Models\AppUser');

    }

    /**
     * Méthode permettantr d'ajouter un utilisateur en bdd
     * @return bool
     */
    public function insert() : bool 
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `app_user` (`email`, `password`, `firstname`, `lastname`, `role`, `status`)
                VALUES (:email, :password, :firstname, :lastname, :role, :status)
        ";

        $query = $pdo->prepare($sql);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':password', $this->password, PDO::PARAM_STR);
        $query->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindParam(':role', $this->role, PDO::PARAM_STR);
        $query->bindParam(':status', $this->status, PDO::PARAM_INT);
        
        $insertedRows = $query->execute();

        if($insertedRows > 0)
        {
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Méthode permettant de modifier un utilisateur en bdd
     * @return bool
     */
    public function update() 
    {

        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `app_user`
            SET
                email = :email,
                password = :password,
                firstname  = :firstname,
                lastname  = :lastname,
                role = :role,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
        ";

        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $this->id);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':password', $this->password, PDO::PARAM_STR);
        $query->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindParam(':role', $this->role, PDO::PARAM_STR);
        $query->bindParam(':status', $this->status, PDO::PARAM_INT);
        
        $updatedRows = $query->execute();

        if($updatedRows > 0)
        {
            return true;
        }
    }

    /**
     * Méthode permettant de supprimer un utilisateur en bdd
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE
                FROM `app_user` 
                WHERE `id` = :id";

        $query = $pdo->prepare($sql);

        $query->bindParam(':id', $this->id);

        $deletedRows = $query->execute();

        if($deletedRows > 0)
        {
            return true;
        }
    }
    

    public function getEmail() {return $this->email;}
    public function getPassword() {return $this->password;}
    public function getFirstname() {return $this->firstname;}
    public function getLastname() {return $this->lastname;}
    public function getRole() {return $this->role;}
    public function getStatus() {return $this->status;}

    public function setEmail($email) {$this->email = $email;}
    public function setPassword($password) {$this->password = $password;}
    public function setFirstname($firstName) {$this->firstname = $firstName;}
    public function setLastname($lastName) {$this->lastname = $lastName;}
    public function setRole($role) {$this->role = $role;}
    public function setStatus($status) {$this->status = $status;}
    
}