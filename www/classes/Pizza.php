<?php

class Pizza{
    private $id;
    private $nom;
    private $prix;

    public function __construct($nom, $prix) {
        $this->setNom($nom);
        $this->setPrix($prix);
    }

    public static function findAll() {
        $stmt = DB::getConnection()->query("SELECT * FROM pizza");
        $lesPizzas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pizza = new Pizza($row['nom'], $row['prix']);
            $pizza->id = $row['id'];
            $lesPizzas[] = $pizza;
        }
        return $lesPizzas;
    }

    public static function find($id){
        $stmt = DB::getConnection()->prepare("SELECT * FROM pizza WHERE id=:id");
        $stmt->execute([
            ':id'=> $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pizzas = new Pizza($row['nom'], $row['prix']);
        $pizzas->id = $row['id'];

        return $pizzas;
    }

    public function save(){
        if(is_null($this->id)){
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO pizza(nom,prix)
                values(:nom, :prix)");
            $stmt->execute([
                ':nom'=> $this->getNom(),
                ':prix'=> $this->getPrix(),
            ]);
            $this->id = DB::getConnection()->lastInsertId();
        }else{
            $stmt = DB::getConnection()->prepare(
                "UPDATE pizza set nom=:nom, prix=:prix
                WHERE id=:id");
            $stmt->execute([
                ':nom'=> $this->getNom(),
                ':prix'=> $this->getPrix(),
                ':id'=> $this->getId()
            ]);
        }
    }


    public function delete(){
        $stmt = DB::getConnection()->prepare(
            "DELETE FROM pizza where id= :id");
        $stmt->execute([
            ':id'=> $this->getId()
        ]);
    }


    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($value){
        $this->nom = $value;
    }

    public function getPrix(){
        return $this->prix;
    }

    public function setPrix($value){
        $this->prix = $value;
    }

    public function getIngredientPizza(){
        return IngredientPizza::findByPizza($this);
    }
    
    public function calculCaloriePizza() {
        $ingredients = IngredientPizza::findByPizza($this);
        $totalCal = 0;
    
        foreach ($ingredients as $ingredientPizza) {
            $ingredient = $ingredientPizza->getIngredient(); 
            $quantite = $ingredientPizza->getQuantite(); 
            $caloriesParGramme = $ingredient->getCaloriesAuGramme();
            $ingredient_calories = $caloriesParGramme * $quantite;
            $totalCal += $ingredient_calories;
        }
    
        return $totalCal;
    }

    public function calculMarge(){
        $prixPizza = $this->getPrix();
        $ingredientPizza = $this->getIngredientPizza();
        $coutIngredient = 0;
        foreach($ingredientPizza as $ip){
            $ingredient = $ip->getIngredient();
            $quantite = $ip->getQuantite();
            $prixAuKilo = $ingredient->getPrix();
            $quantiteKilo = ($quantite/1000);
            $coutIngredient = ($prixAuKilo * $quantiteKilo);
        }
        $marge = ($prixPizza - $coutIngredient);
        $marge = $marge/$prixPizza;
        $marge = $marge*100;

        return $marge;
    }
}
