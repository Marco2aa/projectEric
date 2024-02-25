<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$id_pizza = $_GET['id'];
$pizzas = Pizza::find($_GET['id']);
IngredientPizza::deleteByPizzaId($id_pizza);
PizzaCommande::deleteByPizzaId($id_pizza);
if($pizzas){
    $pizzas->delete();

}




header("Location: ../pizzaliste.php");