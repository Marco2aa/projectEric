<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$id_commande = $_GET['id'];
$commandes = Commande::find($_GET['id']);
PizzaCommande::deleteByCommandeId($id_commande);
if($commandes){
    $commandes->delete();

}

header("Location: ../commandeliste.php");