<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $addd_at;
    /**
     * @var string
     */
    protected $updated_at;


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of addd_at
     *
     * @return  string
     */ 
    public function getAdddAt() : string
    {
        return $this->addd_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }

    /**
     * Permet de forcer les classes qui hérite de CoreController à implémenter les méthodes suivantes
     */
    abstract public static function find($id);
    abstract public static function findAll();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
}
