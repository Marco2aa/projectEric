<?php include("includes/top.php");?>


<?php

    $id = $_GET['id'];
    $pizza = Pizza::find($id);
?>
   <div class="ajouteringredient">
       <h1>Modifier la<?php echo($pizza->getNom());?></h1>
       <form class="form" action="fonctions/fpizzamodifier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo($pizza->getId())?>" required />
            <label for="nom">Nouveau Nom</label>
            <input type="text" name="nom" placeholder="<?php echo($pizza->getNom());?>" required>
            <label for="prix">Nouveau Prix</label>
            <input type="text" name="prix" placeholder="<?php echo($pizza->getPrix());?>" required>
            <?php $lesIngredients=Ingredient::findAll();
        foreach ($lesIngredients as $ingredient) {
            $ip=IngredientPizza::findByIngredientPizza($pizza, $ingredient);
            $quantite=0;
            if(!is_null($ip)){
                $quantite = $ip->getQuantite();
            }
            ?>
        <label for="cours<?php echo($ingredient->getId())?>"><?php echo($ingredient->getNom())?></label>
        <input type="text" placeholder="<?php echo($quantite);?>" name="quantite<?php echo($ingredient->getId())?>" value=<?php echo($quantite);?> />
    
                <?php }?>
            <button class="buttonsubmit" type="submit">Modifier</button>
        </form>
    </div>
<?php include("includes/bottom.php");?>