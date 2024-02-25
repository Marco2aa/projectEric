<?php include("includes/top.php");?>
<div id="divtable">
    <table id="idtable" class="table table-dark bg-transparent">
      <thead>
        <tr>
          <th class="bg-transparent scope="col">Top Seller</th>
          <th class="bg-transparent scope="col">Top Eater</th>
          <th class="bg-transparent scope="col">Panier Moyen</th>
          <th class="bg-transparent">Top 3 Ingredients</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="bg-transparent">
            <?php
            $PizzaLaPlusVendu = Pizza::findPizzaLaPlusVendu();
            if (!is_null($PizzaLaPlusVendu)) {
                echo "<p>La pizza la plus vendue est : " . $PizzaLaPlusVendu->getNom() . "</p>";
            } else {
                echo "<p>Aucune pizza n'a été vendue pour le moment.</p>";
            }
            ?>
        </td>
          <td class="bg-transparent">
            <?php
            $leGlouton = Client::findLeGlouton();
            if(!is_null($leGlouton)){
                echo"<p>Celui qui a mangé le plus de Pizzas differente est : ". $leGlouton->getNomClient(). "</p>";
            }else{
                echo"<p>Aucun client n'a été trouvé pour le moment</p>";
            }
            ?>
          </td>
          <td class="bg-transparent">
            <?php
            $panierMoyen = Commande::calculPanierMoyen();
            if(!is_null($panierMoyen)){
                echo"<p>Le panier moyen chez Pineapple On Pizza est de : ". $panierMoyen ." Euros</p>";
            }else{
                echo"<p>Pas assez de données</p>";
            }
            ?>
          </td>
          <td class="bg-transparent">
          <?php
            $topTroisIngredients = Ingredient::topTroisIngredient();
            if(!is_null($topTroisIngredients)){
                $i = 0;
                foreach($topTroisIngredients as $ingredient){
                    $i += 1;
                    echo"<p> L'ingredient N° ".$i." est ".$ingredient->getNom()."</p>";
    
    
                }
            }else{
                echo('<p>Pas assez de données </p>');
            }
            ?>
          </td>
        </tr>

      </tbody>
    </table>
</div>
<?php include("includes/bottom.php");?>