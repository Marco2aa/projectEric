<?php include("includes/top.php");?>
<div class="ajouteringredient">
    <h1>Créer un client</h1>
    <form class="form" action="fonctions/fclientajouter.php" method="POST">
        <label for="nom">Nom du Client</label>
        <input type="text" name="nom">

            <button class="buttonsubmit" type="submit">Créer</button>
        </form>
    </div>

<?php include("includes/bottom.php");?>