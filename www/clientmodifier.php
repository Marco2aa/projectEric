<?php include("includes/top.php");?>


<?php

    $id = $_GET['id'];
    $client = Client::find($id);
?>
   <div class="ajouteringredient">
       <h1>Modifier le client N°<?php echo($client->getId());?></h1>
       <form class="form" action="fonctions/fclientmodifier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo($client->getId())?>" required />
            <label for="nom">Nouveau nom du Client</label>
            <input type="text" name="nom">
            <button class="buttonsubmit" type="submit">Modifier</button>
        </form>
    </div>
<?php include("includes/bottom.php");?>