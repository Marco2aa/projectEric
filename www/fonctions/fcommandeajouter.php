<?php


require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");
$date = $_POST['date'];
$table = $_POST['table'];
$idClient = $_POST['client'];
$client = Client::find($idClient);
if($client){
    $commande = new Commande($date, $table,$client->getId());
    $commande->save();
    $lesPizzas = Pizza::findAll();
    foreach($lesPizzas as $pizza){
        $nombre = $_POST['nombre'.$pizza->getId()];
        if($nombre>0){
        $pizzaCommande = new PizzaCommande($commande,$pizza,$nombre);
        $pizzaCommande->save();
        }
    
    }

}






header('Location: ../commandeliste.php');
exit();
?>