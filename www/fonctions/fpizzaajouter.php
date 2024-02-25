<?php


require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");
$nom = $_POST['nom'];
$prix = $_POST['prix'];
$pizza = new Pizza($nom, $prix);
$pizza->save();
$lesIngredients = Ingredient::findAll();
foreach($lesIngredients as $ingredient){
    $quantite = $_POST['quantite'.$ingredient->getId()];
    if($quantite>0){
        $ingredientPizza = new IngredientPizza($quantite,$pizza,$ingredient);
        $ingredientPizza->save();
    }
}




header('Location: ../pizzaliste.php');
exit();
?>