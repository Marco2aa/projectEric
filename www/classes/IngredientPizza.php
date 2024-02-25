<?php

class IngredientPizza{
    private $id;
    private $pizza;
    private $ingredient;
    private $quantite;

    public function __construct($quantite,$pizza,$ingredient) {
        $this->setPizza($pizza);
        $this->setIngredient($ingredient);
        $this->setQuantite($quantite);
    }

    public static function find($id) {
        $stmt = DB::getConnection()->prepare("SELECT * FROM ingredientPizza WHERE id_ingredient=:id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $ingredient = Ingredient::find($row['id_ingredient']);
        $pizza = Pizza::find($row['id_pizza']);
        $objet = new IngredientPizza($row['quantite'], $pizza,$ingredient);
        $objet->id = $row['id'];
        return $objet;
    }

    public static function findByPizza($pizza){
        $stmt = DB::getConnection()->prepare("SELECT * FROM ingredientPizza WHERE id_pizza=:id");
        $stmt->execute([':id' => $pizza->getId()]);
        $tab = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ingredient=Ingredient::find($row['id_ingredient']);
            $tab[] = new IngredientPizza($row['quantite'], $pizza, $ingredient);

        }
        return $tab;
    }

    public static function findByIngredientPizza($pizza, $ingredient){
        $stmt = DB::getConnection()->prepare("SELECT * FROM ingredientPizza WHERE id_pizza=:id_pizza and id_ingredient=:id_ingredient");
        $stmt->execute([
            ':id_pizza' => $pizza->getId(),
            ':id_ingredient' => $ingredient->getId()
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row==false){
            return null;
        }
        $ip=IngredientPizza::find($row['id_pizza']);
        return $ip;
    }

    public function save(){
        if(is_null($this->id)){
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO ingredientPizza(quantite,id_ingredient,id_pizza)
                values(:quantite, :ingredient, :pizza)");
            $stmt->execute([
                ':quantite'=> intval($this->getQuantite()),
                ':ingredient'=> intval($this->getIngredient()->getId()),
                ':pizza'=> intval($this->getPizza()->getId()),
            ]);
            $this->id = DB::getConnection()->lastInsertId();
        }else{
            $stmt = DB::getConnection()->prepare(
                "UPDATE ingredientPizza set quantite=:quantite, id_ingredient=:ingredient, id_pizza=:pizza
                WHERE id=:id");
            $stmt->execute([
                ':quantite'=> $this->getQuantite(),
                ':ingredient'=> $this->getIngredient()->getId(),
                ':pizza'=> $this->getPizza()->getId(),
                ':id'=> $this->getId()
            ]);
        }
    }

    public function delete(){
        $stmt = DB::getConnection()->prepare("DELETE FROM ingredientPizza WHERE id=:id");
        $stmt->execute([
            ':id' => $this->id
        ]);
    }

    public static function deleteByPizzaId($pizza) {
        $stmt = DB::getConnection()->prepare("DELETE FROM ingredientPizza WHERE id_pizza=:pizza");
        $stmt->execute([':pizza' => $pizza]);
    }

    public static function deleteByIngredientId($ingredient) {
        $stmt = DB::getConnection()->prepare("DELETE FROM ingredientPizza WHERE id_ingredient=:ingredient");
        $stmt->execute([':ingredient' => $ingredient]);
    }

    
    public static function deleteByIngredientPizza($pizza, $ingredient) {
        $stmt = DB::getConnection()->prepare("DELETE FROM ingredientPizza WHERE id_pizza = :pizza_id AND id_ingredient = :ingredient_id");
        $stmt->execute([
            ':pizza_id' => $pizza->getId(),
            ':ingredient_id' => $ingredient->getId()
        ]);
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
    public function getIngredient(){
        return $this->ingredient;
    }

    public function setIngredient($value){
        $this->ingredient = $value;

    }
    public function getQuantite(){
        return $this->quantite;
    }

    public function setQuantite($value){

        $this->quantite = $value;
    }
}