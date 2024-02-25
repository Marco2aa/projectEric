<?php

class PizzaCommande{
    private $id;
    private $commande;
    private $pizza;
    private $nombre;

    public function __construct($commande,$pizza,$nombre) {
        $this->setCommande($commande);
        $this->setPizza($pizza);
        $this->setNombre($nombre);
    }

    public static function find($id) {
        $stmt = DB::getConnection()->prepare("SELECT * FROM pizzaCommande WHERE id_pizza=:id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $pizza = Pizza::find($row['id_pizza']);
        $commande = Commande::find($row['id_commande']);
        $objet = new PizzaCommande( $commande,$pizza,$row['nombre']);
        $objet->id = $row['id'];
        return $objet;
    }

    public static function findByCommande($commande){
        $stmt = DB::getConnection()->prepare("SELECT * FROM pizzaCommande WHERE id_commande=:id");
        $stmt->execute([':id' => $commande->getId()]);
        $tab = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pizza=Pizza::find($row['id_pizza']);
            $tab[] = new PizzaCommande($commande, $pizza,$row['nombre']);

        }
        return $tab;
    }

    public static function findByPizzaCommande($commande, $pizza){
        $stmt = DB::getConnection()->prepare("SELECT * FROM pizzaCommande WHERE id_pizza=:id_pizza and id_commande=:id_commande");
        $stmt->execute([
            ':id_pizza' => $pizza->getId(),
            ':id_commande' => $commande->getId()
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row==false){
            return null;
        }
        $pc=PizzaCommande::find($row['id_commande']);
        return $pc;
    }

    public function save(){
        if(is_null($this->id)){
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO pizzaCommande(id_pizza,id_commande,nombre)
                values( :pizza, :commande, :nombre)");
            $stmt->execute([
                ':pizza'=> intval($this->getPizza()->getId()),
                ':commande'=> intval($this->getCommande()->getId()),
                ':nombre'=>intval($this->getNombre()),
            ]);
            $this->id = DB::getConnection()->lastInsertId();
        }else{
            $stmt = DB::getConnection()->prepare(
                "UPDATE pizzaCommande set id_pizza=:pizza, id_commande=:commande, nombre=:nombre
                WHERE id=:id");
            $stmt->execute([
                ':pizza'=> $this->getPizza()->getId(),
                ':commande'=> $this->getCommande()->getId(),
                ':nombre'=> $this->getNombre(),
                ':id'=> $this->getId()
            ]);
        }
    }

    public function delete(){
        $stmt = DB::getConnection()->prepare("DELETE FROM pizzaCommande WHERE id=:id");
        $stmt->execute([
            ':id' => $this->id
        ]);
    }

    public static function deleteByCommandeId($commande) {
        $stmt = DB::getConnection()->prepare("DELETE FROM pizzaCommande WHERE id_commande=:commande");
        $stmt->execute([':commande' => $commande]);
    }

    
    public static function deleteByIngredientPizza($commande, $pizza) {
        $stmt = DB::getConnection()->prepare("DELETE FROM pizzaCommande WHERE id_commande = :commande_id AND id_pizza = :pizza_id");
        $stmt->execute([
            ':commande_id' => $commande->getId(),
            ':pizza_id' => $pizza->getId()
        ]);
    }

    public static function deleteByPizzaId($pizza) {
        $stmt = DB::getConnection()->prepare("DELETE FROM pizzaCommande WHERE id_pizza=:pizza");
        $stmt->execute([':pizza' => $pizza]);
    }
    
    

    public function getId(){
        return $this->id;
    }

    public function getPizza(){
        return $this->pizza;
    }

    public function setPizza($value){
        $this->pizza = $value;
        
    }
    public function getCommande(){
        return $this->commande;
    }

    public function setCommande($value){
        $this->commande = $value;

    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($value){
        $this->nombre = $value;
    }

}