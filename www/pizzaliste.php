<?php include("includes/top.php");?>
<div id="divtable">
    <?php $mesPizzas = Pizza::findAll(); ?>

    <table id="idtable" class="table table-dark bg-transparent" class="table-hover">
      <thead>
        <tr class="hover">
          <th class="bg-transparent scope="col">Nom</th>
          <th class="bg-transparent scope="col">Prix</th>
          <th class="bg-transparent scope="col">Liste Ingredients</th>
          <th class="bg-transparent scope="col">Calories totale</th>
          <th class="bg-transparent scope="col">Marge en %</th>
          <th class="bg-transparent">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($mesPizzas as $pizza){
          ?>
          <tr class="hover">

          <td class="bg-transparent"><?php echo($pizza->getNom());?></td>
          <td class="bg-transparent"><?php echo($pizza->getPrix());?></td>
          <td class="bg-transparent">
            <?php $ingredientPizzas = $pizza->getIngredientPizza();
            $listeIngredient = [];
            foreach($ingredientPizzas as $ingredientPizza){
              echo($ingredientPizza->getingredient()->getNom());
              echo('<br>');
            } ?>
          </td>
          <td class="bg-transparent"><?php echo($pizza->calculCaloriePizza());?></td>
          <td class="bg-transparent"><?php echo($pizza->calculMarge());?>%</td>
          <td class="bg-transparent"><?php echo($pizza->getPrix());?></td>
          <td class="bg-transparent"><a class="links" href="pizzamodifier.php?id=<?php echo($pizza->getId());?>">Modifier</a><a class="links" href="fonctions/fpizzasupprimer.php?id=<?php echo($pizza->getId());?>">Supprimer</a></td>
        </tr>
      <?php  } ?>
      </tbody>
    </table>
</div>
<?php include("includes/bottom.php");?>