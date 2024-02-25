<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$clients = Client::find($_POST['id']);
$clients->setNomClient($_POST['nom']);
$clients->save();

header("Location: ../ingredientsliste.php");