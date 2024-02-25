<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$id_ingredient = $_GET['id'];
$ingredients = Ingredient::find($_GET['id']);
IngredientPizza::deleteByIngredientId($id_ingredient);
if($ingredients){
    $ingredients->delete();

}

header("Location: ../ingredientsliste.php");