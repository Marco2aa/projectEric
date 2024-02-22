<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$ingredients = Ingredient::find($_POST['id']);
$ingredients->setNom($_POST['nom']);
$ingredients->setPrix($_POST['prix']);
$ingredients->setCaloriesAuGramme($_POST['calorie']);
$ingredients->save();

header("Location: ../ingredientsliste.php");