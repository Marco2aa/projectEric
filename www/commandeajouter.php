<?php include("includes/top.php");?>
<div class="ajouteringredient">
    <h1>Créer une commande</h1>
    <form class="form" action="fonctions/fcommandeajouter.php" method="POST">
        <label for="date">Date de la commande</label>
        <input type="datetime-local" name="date">
        <label for="table">Numero de table</label>
        <input type="text" name="table">
        
        <?php $mesPizzas = Pizza::findAll();
            foreach($mesPizzas as $pizza){
                ?>
            <label for="nombre"><?php echo($pizza->getNom());?></label>
            <input type="text" name="nombre<?php echo($pizza->getId());?>" placeholder="Gramme" value="0" required>
            <?php } ?>

            <label for="client">Sélectionner le client :</label><br>
            <?php 
            $mesClients = Client::findAll();
            foreach($mesClients as $client){
            ?>
            <input type="radio" id="client<?php echo($client->getId()); ?>" name="client" value="<?php echo($client->getId()); ?>">
            <label for="client<?php echo($client->getId()); ?>"><?php echo($client->getNomClient()); ?></label><br>
            <?php } ?>

            <button class="buttonsubmit" type="submit">Créer</button>
        </form>
    </div>

<?php include("includes/bottom.php");?>