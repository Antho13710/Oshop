<?php

namespace App\Models;

use PDO;
use App\Models\Tag;
use App\Utils\Database;

/**
 * Une instance de Product = un produit dans la base de données
 * Product hérite de CoreModel
 */
class Product extends CoreModel {
    
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $type_id;
    
    /**
     * Méthode permettant de récupérer un enregistrement de la table Product en fonction d'un id donné
     * 
     * @param int $productId ID du produit
     * @return Product
     */
    public static function find($productId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = 'SELECT `product`.*,
        `type`.`name` AS `product_type`,
        `brand`.`name` AS `product_brand`,
        `category`.`name` AS `product_category`
        FROM `product`
        LEFT JOIN `type` ON `type`.`id` = `product`.`type_id`
        LEFT JOIN `brand` ON `brand`.`id` = `product`.`brand_id`
        LEFT JOIN `category` ON `category`.`id` = `product`.`category_id`
        WHERE `product`.`id` =' . $productId;

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $pdoStatement = $pdo->query($sql);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $result = $pdoStatement->fetchObject('App\Models\Product');
        
        return $result;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table product
     * 
     * @return Product[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');
        
        return $results;
    }

    /**
     * Méthode permettant de récupérer l'ensemble des produits selon un critère de tri (par marques, par types, etc...)
     * @param int $id
     * @param string $sort_id
     * @return Product[]
     */
    public static function findAllBy($id, $sort_id)
    {
        $sql = "SELECT * 
                FROM `product`
                WHERE $sort_id = ".$id;

        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');
        
        return $results;
    }

    /**
     * Méthode permettant de récupérer la liste des produits affichés sur la home du backoffice
     * @return Product[]
     */
    public static function findLast($p_limit = 3)
    {
        $pdo = Database::getPDO();
        $sql = "
            SELECT *
            FROM `product`
            ORDER BY `id` DESC
            LIMIT $p_limit
        ";
        $pdoStatement = $pdo->query($sql);
        $product = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');
        
        return $product;
    }

    public function getTags()
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM product_has_tag WHERE product_id = :id";

        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $this->id, PDO::PARAM_INT);
        $query->execute();

        $tags = $query->fetchAll(PDO::FETCH_ASSOC);

        $tagsArray = [];

        foreach($tags as $tagData)
        {
            $tagsArray[] = Tag::find($tagData['tag_id']);
        }

        return $tagsArray;
    }

    /**
     * Insert le nouveau produit
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `product` (name, description, picture, price, rate, status, brand_id, category_id, type_id)
            VALUES (:name, :description, :picture, :price, :rate, :status, :brand_id, :category_id, :type_id)
        ";

        $query = $pdo->prepare($sql);

        $query->bindParam(":name", $this->name, PDO::PARAM_STR);
        $query->bindParam(":description", $this->description, PDO::PARAM_STR);
        $query->bindParam(":picture", $this->picture, PDO::PARAM_STR);
        $query->bindParam(":price", $this->price);
        $query->bindParam(":rate", $this->rate, PDO::PARAM_INT);
        $query->bindParam(":status", $this->status, PDO::PARAM_INT);
        $query->bindParam(":brand_id", $this->brand_id, PDO::PARAM_INT);
        $query->bindParam(":category_id", $this->category_id, PDO::PARAM_INT);
        $query->bindParam(":type_id", $this->type_id, PDO::PARAM_INT);

        $insertedRows = $query->execute();

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
     * Méthode permettant la modification d'un produit en bdd
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `product`
            SET
                name = :name,
                description = :description,
                picture  = :picture,
                price = :price,
                rate = :rate,
                status = :status,
                brand_id = :brand_id,
                category_id = :category_id,
                type_id = :type_id,
                updated_at = NOW()
            WHERE id = :id
        ";

        $query = $pdo->prepare($sql);

        $query->bindParam(":id", $this->id);
        $query->bindParam(":name", $this->name, PDO::PARAM_STR);
        $query->bindParam(":description", $this->description, PDO::PARAM_STR);
        $query->bindParam(":picture", $this->picture, PDO::PARAM_STR);
        $query->bindParam(":price", $this->price);
        $query->bindParam(":rate", $this->rate, PDO::PARAM_INT);
        $query->bindParam(":status", $this->status, PDO::PARAM_INT);
        $query->bindParam(":brand_id", $this->brand_id, PDO::PARAM_INT);
        $query->bindParam(":category_id", $this->category_id, PDO::PARAM_INT);
        $query->bindParam(":type_id", $this->type_id, PDO::PARAM_INT);

        $updatedRows = $query->execute();

        if($updatedRows > 0)
        {
            return true;
        }
    }

    /**
     * Méthode permettant la suppression d'un produit en bdd
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE
                FROM `product` 
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
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */ 
    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     *
     * @return  int
     */ 
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     */ 
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */ 
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     */ 
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
    }
}
