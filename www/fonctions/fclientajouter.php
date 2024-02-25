<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");
$nom = $_POST['nom'];
$clients = new Client($nom);

$clients->save();

header('Location: ../clientliste.php');