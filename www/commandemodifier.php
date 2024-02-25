<?php include("includes/top.php");?>


<?php

    $id = $_GET['id'];
    $commande = Commande::find($id);
?>
   <div class="ajouteringredient">
       <h1>Modifier la commande</h1>
       <form class="form" action="fonctions/fcommandemodifier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo($commande->getId())?>" required />
            <label for="date">Modifier date</label>
            <input type="datetime-local" name="date" placeholder="<?php echo($commande->getDate());?>">
            <label for="table">Modifier la table</label>
            <input type="text" name="table" placeholder="<?php echo($commande->getTable());?>">
            <?php $lesPizzas=Pizza::findAll();
        foreach ($lesPizzas as $pizza) {
            $pc=PizzaCommande::findByPizzaCommande($commande, $pizza);
            $nombre=0;
            if(!is_null($pc)){
                $nombre = $pc->getNombre();
            }
            ?>
            <div class="mb-3 row">
                <label for="cours<?php echo($pizza->getId())?>" class="col-sm-1 col-form-label"><?php echo($pizza->getNom())?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nombre<?php echo($pizza->getId())?>" value=<?php echo($nombre);?> />
                </div>
            </div>
                <?php }?>
            <button class="buttonsubmit" type="submit">Modifier</button>
        </form>
    </div>
<?php include("includes/bottom.php");?>