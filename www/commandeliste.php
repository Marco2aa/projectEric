<?php include("includes/top.php");?>
<div id="divtable">
    <?php $mesCommandes = Commande::findAll(); ?>

    <table id="idtable" class="table table-dark bg-transparent" class="table-hover">
      <thead>
        <tr class="hover">
          <th class="bg-transparent scope="col">Date et heure</th>
          <th class="bg-transparent scope="col">Numero de table</th>
          <th class="bg-transparent scope="col">Nom du client</th>
          <th class="bg-transparent scope="col">Liste des Pizza</th>
          <th class="bg-transparent scope="col">Prix Total</th>
          <th class="bg-transparent">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($mesCommandes as $commande){
          $client = Client::find($commande->getIdClient());
          ?>
          <tr class="hover">

          <td class="bg-transparent"><?php echo($commande->getDate());?></td>
          <td class="bg-transparent"><?php echo($commande->getTable());?></td>
          <td class="bg-transparent"><?php echo($client->getNomClient())?></td>
          <td class="bg-transparent">
              <?php $pizzaCommandes = $commande->getCommandePizza();
            $listePizza = [];
            foreach($pizzaCommandes as $pc){
                echo($pc->getNombre().' '.$pc->getPizza()->getNom());
                echo('<br>');
            } ?>
          </td>
          <td class="bg-transparent"><?php echo($commande->calculPrixTotal());?> Euros</td>
          <td class="bg-transparent"><a class="links" href="commandemodifier.php?id=<?php echo($commande->getId());?>">Modifier</a><a class="links" href="fonctions/fcommandesupprimer.php?id=<?php echo($commande->getId());?>">Supprimer</a></td>
        </tr>
      <?php  } ?>
      </tbody>
    </table>
</div>
<?php include("includes/bottom.php");?>