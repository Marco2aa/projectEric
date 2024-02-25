<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$commandes = Commande::find($_POST['id']);
$commandes->setDate($_POST['date']);
$commandes->setTable($_POST['table']);
$commandePizza = $commandes->getCommandePizza();
$id_commande = ($_POST['id']);
foreach($commandePizza as $cp){
    $cp->deleteByCommandeId($id_commande);
}
$lesPizzas = Pizza::findAll();
foreach ($lesPizzas as $pizza) {
    $nombre = $_POST['nombre'.$pizza->getId()];
    if($nombre>0){
    $pizzaCommandes = new PizzaCommande($commandes,$pizza,$nombre);
    $pizzaCommandes->save();
    }
}





$commandes->save();

header("Location: ../commandeliste.php");