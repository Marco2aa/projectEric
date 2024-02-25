<?php include("includes/top.php");?>
<div id="divtable">
    <?php $mesClients = Client::findAll(); ?>
    <table id="idtable" class="table table-dark bg-transparent">
      <thead>
        <tr>
          <th class="bg-transparent scope="col">Nom</th>
          <th class="bg-transparent">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($mesClients as $client){
          ?>
          <tr>
          <td class="bg-transparent"><?php echo($client->getNomClient());?></td>
          <td class="bg-transparent"><a class="links" href="clientmodifier.php?id=<?php echo($client->getId());?>">Modifier</a><a class="links" href="fonctions/fclientsupprimer.php?id=<?php echo($client->getId());?>">Supprimer</a></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
</div>
<?php include("includes/bottom.php");?>