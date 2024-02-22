<?php include("includes/top.php");?>

    <div class="ajouteringredient">
        <h1>Créer un ingredient</h1>
        <form class="form" action="fonctions/fingredientsajouter.php" method="POST">
            <label for="nom">Nom de l'ingredient</label>
            <input type="text" name="nom">
            <label for="prix">Prix</label>
            <input type="text" name="prix">
            <label for="calorie">Calories au gramme</label>
            <input type="text" name="calorie">
            <button class="buttonsubmit" type="submit">Créer</button>
        </form>
    </div>

<?php include("includes/bottom.php");?>