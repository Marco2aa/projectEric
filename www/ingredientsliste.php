<?php include("includes/top.php");?>
<div id="divtable">
    <?php $mesIngredients = Ingredient::findAll(); ?>
    <table id="idtable" class="table table-dark bg-transparent">
      <thead>
        <tr>
          <th class="bg-transparent scope="col">Nom</th>
          <th class="bg-transparent scope="col">Prix au kilo</th>
          <th class="bg-transparent scope="col">Calorie au gramme</th>
          <th class="bg-transparent">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($mesIngredients as $ingredient){
          ?>
          <tr>
          <td class="bg-transparent"><?php echo($ingredient->getNom());?></td>
          <td class="bg-transparent"><?php echo($ingredient->getPrix());?> Euros</td>
          <td class="bg-transparent"><?php echo($ingredient->getCaloriesAuGramme());?> Cal/g</td>
          <td class="bg-transparent"><a class="links" href="ingredientsmodifier.php?id=<?php echo($ingredient->getId());?>">Modifier</a><a class="links" href="fonctions/fingredientssupprimer.php?id=<?php echo($ingredient->getId());?>">Supprimer</a></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
</div>
<?php include("includes/bottom.php");?>