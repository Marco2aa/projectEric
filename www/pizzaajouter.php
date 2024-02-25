<?php include("includes/top.php");?>
<div class="ajouteringredient">
    <h1>Créer une pizza</h1>
    <form class="form" action="fonctions/fpizzaajouter.php" method="POST">
        <label for="nom">Nom de la Pizza</label>
        <input type="text" name="nom">
        <label for="prix">Prix</label>
        <input type="text" name="prix">
        
        <?php $mesIngredients = Ingredient::findAll();
            foreach($mesIngredients as $ingredient){
                ?>
            <label for="quantite"><?php echo($ingredient->getNom());?></label>
            <input type="text" name="quantite<?php echo($ingredient->getId());?>" placeholder="Gramme" value="0" required>
            <?php } ?>

            <button class="buttonsubmit" type="submit">Créer</button>
        </form>
    </div>

<?php include("includes/bottom.php");?>