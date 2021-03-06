<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    public static function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $categoryId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject('App\Models\Category');

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * @return Category[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     * @return Category[]
     */
    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $category = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $category;
    }

    /**
     * Récupérer les catégories visibles sur la home du back office
     * @return Category[]
     */
    public static function findLast($p_limit = 3)
    {
        $pdo = Database::getPDO();
        $sql = "
            SELECT *
            FROM `category`
            ORDER BY `id` DESC
            LIMIT $p_limit
        ";
        $pdoStatement = $pdo->query($sql);
        $category = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $category;
    }

    /**
     * Insert la nouvelle catégorie
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES (:name, :subtitle, :picture)
        ";

        $query = $pdo->prepare($sql);

        $insertedRows = $query->execute([
            ':name' => $this->name,
            ':subtitle' => $this->subtitle,
            ':picture' => $this->picture
        ]);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    /**
     * Méthode permettant de modifier une catégorie demandée en bdd
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `category`
            SET
                name = :name,
                subtitle = :subtitle,
                picture  = :picture,
                home_order = :home_order,
                updated_at = NOW()
            WHERE id = :id
        ";

        $query = $pdo->prepare($sql);

        $query->bindParam(':name', $this->name, PDO::PARAM_STR);
        $query->bindParam(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $query->bindParam(':picture', $this->picture, PDO::PARAM_STR);
        $query->bindParam(':home_order', $this->home_order, PDO::PARAM_STR);
        $query->bindParam(':id', $this->id);

        $updatedRows = $query->execute();

        if($updatedRows > 0)
        {
            return true;
        }
    }

    /**
     * Méthode permettant de supprimer une catégorie en bdd
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE
                FROM `category` 
                WHERE `id` = :id";

        $query = $pdo->prepare($sql);

        $query->bindParam(':id', $this->id);

        $deletedRows = $query->execute();

        if($deletedRows > 0)
        {
            return true;
        }
    }

    /**
     * Méthode permettant de mettre toutes les collonnes home_order à 0 en bdd
     * @return void
     */
    public static function resetHomeOrder()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `category`
            SET
                home_order = 0
        ";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
    }

    /**
     * Méthode permettant de modifier la colonne home_order d'une catégorie en bdd
     * @return bool
     */
    public function updateHomeOrder()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `category`
            SET
                home_order = :home_order,
                updated_at = NOW()
            WHERE id = :id
        ";

        $query = $pdo->prepare($sql);

        $query->bindParam(':home_order', $this->home_order);
        $query->bindParam(':id', $this->id);

        $updatedRows = $query->execute();

        if($updatedRows > 0)
        {
            return true;
        }
    }


}
