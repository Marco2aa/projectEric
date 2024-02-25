<?php

class Commande{
    private $id;
    private $date;
    private $table;
    private $id_client;

    public function __construct($date, $table,$id_client) {
        $this->setDate($date);
        $this->setTable($table);
        $this->setIdClient($id_client);
    }

    public static function findAll() {
        $stmt = DB::getConnection()->query("SELECT * FROM commande");
        $lesCommandes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $commande = new Commande($row['dateCommande'], $row['tableCommande'],$row['id_client']);
            $commande->id = $row['id'];
            $lesCommandes[] = $commande;
        }
        return $lesCommandes;
    }

    public static function find($id){
        $stmt = DB::getConnection()->prepare("SELECT * FROM commande WHERE id=:id");
        $stmt->execute([
            ':id'=> $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $commande = new Commande($row['dateCommande'], $row['tableCommande'],$row['id_client']);
        $commande->id = $row['id'];

        return $commande;
    }

    public function save(){
        if(is_null($this->id)){
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO commande(dateCommande,tableCommande,id_client)
                values(:date, :table, :id_client)");
            $stmt->execute([
                ':date'=> $this->getDate(),
                ':table'=> $this->getTable(),
                ':id_client'=>$this->getIdClient(),
            ]);
            $this->id = DB::getConnection()->lastInsertId();
        }else{
            $stmt = DB::getConnection()->prepare(
                "UPDATE commande set dateCommande=:date, tableCommande=:table, id_client=:id_client
                WHERE id=:id");
            $stmt->execute([
                ':date'=> $this->getDate(),
                ':table'=> $this->getTable(),
                ':id_client'=>$this->getIdClient(),
                ':id'=> $this->getId()
            ]);
        }
    }

    public function getClient() {
        if ($this->id_client) {
            return Client::find($this->id_client);
    }
}
    


    public function delete(){
        $stmt = DB::getConnection()->prepare(
            "DELETE FROM commande where id= :id");
        $stmt->execute([
            ':id'=> $this->getId()
        ]);
    }


    public function getId(){
        return $this->id;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($value){
        $this->date = $value;
    }

    public function getTable(){
        return $this->table;
    }

    public function setTable($value){
        $this->table = $value;
    }

    public function setIdClient($value){
        $this->id_client = $value;
    }

    public function getIdClient(){
        return $this->id_client;
    }

    public function getCommandePizza(){
        return PizzaCommande::findByCommande($this);
    }
    
    public function calculPrixTotal(){
        $pizzas = PizzaCommande::findByCommande($this);
        $prixTotal = 0;

        foreach($pizzas as $pizza){
            $prixPizza = ($pizza->getPizza()->getPrix())*($pizza->getNombre());
            $prixTotal += $prixPizza;
        }
        return $prixTotal;
    }

    /*public static function calculPanierMoyen() {
        $stmt = DB::getConnection()->query("
            SELECT AVG(prixTotal) AS panierMoyen
            FROM (
                SELECT SUM(pizza.prix) AS prixTotal
                FROM commande 
                JOIN pizzaCommande  ON commande.id = pizzaCommande.id_commande
                JOIN pizza  ON pizzaCommande.id_pizza = pizza.id
                GROUP BY commande.id
            ) AS subquery
        ");
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return $row['panierMoyen'];
        } else {
            return 0;
        }
    }*/

   /* public static function calculPanierMoyen() {
        $stmt = DB::getConnection()->query("
            SELECT AVG(prixTotal) AS panierMoyen
            FROM (
                SELECT SUM(pizza.prix) AS prixTotal
                FROM commande 
                JOIN pizzaCommande ON commande.id = pizzaCommande.id_commande
                JOIN pizza ON pizzaCommande.id_pizza = pizza.id
                GROUP BY pizzaCommande.id_commande
            ) AS subquery
        ");
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return $row['panierMoyen'];
        } else {
            return 0;
        }
    } */
    
    
    public static function calculPanierMoyen() {
        $stmt = DB::getConnection()->query("
            SELECT AVG(prixTotal) AS panierMoyen
            FROM (
                SELECT SUM(pizza.prix * pizzaCommande.nombre) AS prixTotal
                FROM commande 
                JOIN pizzaCommande ON commande.id = pizzaCommande.id_commande
                JOIN pizza ON pizzaCommande.id_pizza = pizza.id
                GROUP BY commande.id
            ) AS subquery
        ");
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return $row['panierMoyen'];
        } else {
            return 0;
        }
    }
    
    
    
}
