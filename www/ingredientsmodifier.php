<?php include("includes/top.php");?>


<?php

    $id = $_GET['id'];
    $ingredient = Ingredient::find($id);
?>
   <div class="ajouteringredient">
       <h1>Modifier l'ingredient N°<?php echo($ingredient->getNom());?></h1>
       <form class="form" action="fonctions/fingredientmodifier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo($ingredient->getId())?>" required />
            <label for="nom">Nom de l'ingredient</label>
            <input type="text" name="nom">
            <label for="prix">Prix</label>
            <input type="text" name="prix">
            <label for="calorie">Calories au gramme</label>
            <input type="text" name="calorie">
            <button class="buttonsubmit" type="submit">Modifier</button>
        </form>
    </div>
<?php include("includes/bottom.php");?>