<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");
$nom = $_POST['nom'];
$prix = $_POST['prix'];
$calorie = $_POST['calorie'];
$ingredients = new Ingredient($nom, $prix, $calorie);

$ingredients->save();

header('Location: ../ingredientsliste.php');