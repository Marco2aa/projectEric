<?php

class Ingredient{
    private $id;
    private $nom;
    private $prix;
    private $caloriesAuGramme;

    public function __construct($nom, $prix, $caloriesAuGramme) {
        $this->setNom($nom);
        $this->setPrix($prix);
        $this->setCaloriesAuGramme($caloriesAuGramme);
    }

    public static function findAll() {
        $stmt = DB::getConnection()->query("SELECT * FROM ingredients");
        $lesIngredients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ingredients = new Ingredient($row['nom'], $row['prix'],$row['calorie']);
            $ingredients->id = $row['id'];
            $lesIngredients[] = $ingredients;
        }
        return $lesIngredients;
    }

    public static function find($id){
        $stmt = DB::getConnection()->prepare("SELECT * FROM ingredients WHERE id=:id");
        $stmt->execute([
            ':id'=> $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ingredients = new Ingredient($row['nom'], $row['prix'],$row['calorie']);
        $ingredients->id = $row['id'];

        return $ingredients;
    }

    public function save(){
        if(is_null($this->id)){
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO ingredients(nom,prix,calorie)
                values(:nom, :prix, :calorie)");
            $stmt->execute([
                ':nom'=> $this->getNom(),
                ':prix'=> $this->getPrix(),
                ':calorie'=>$this->getCaloriesAuGramme(),
            ]);
            $this->id = DB::getConnection()->lastInsertId();
        }else{
            $stmt = DB::getConnection()->prepare(
                "UPDATE ingredients set nom=:nom, prix=:prix, calorie=:calorie
                WHERE id=:id");
            $stmt->execute([
                ':nom'=> $this->getNom(),
                ':prix'=> $this->getPrix(),
                ':calorie'=>$this->getCaloriesAuGramme(),
                ':id'=> $this->getId()
            ]);
        }
    }


    public function delete(){
        $stmt = DB::getConnection()->prepare(
            "DELETE FROM ingredients where id= :id");
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

    public function getCaloriesAuGramme(){
        return $this->caloriesAuGramme;
    }

    public function setCaloriesAuGramme($value){
        $this->caloriesAuGramme = $value;
    }
}