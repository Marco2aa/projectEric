<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$pizzas = Pizza::find($_POST['id']);
$pizzas->setNom($_POST['nom']);
$pizzas->setPrix($_POST['prix']);
$ingredientPizza = $pizzas->getIngredientPizza();
$id_pizza = ($_POST['id']);
foreach($ingredientPizza as $ip){
    $ip->deleteByPizzaId($id_pizza);
}
$lesIngredients = Ingredient::findAll();
foreach ($lesIngredients as $ingredient) {
    $quantite = $_POST["quantite".$ingredient->getId()];
    if($quantite>0){
        $ingredientPizzas = new IngredientPizza($quantite, $pizzas, $ingredient);
        $ingredientPizzas->save();
    }
}



$pizzas->save();

header("Location: ../pizzaliste.php");