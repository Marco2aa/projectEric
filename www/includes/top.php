<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-secondary-subtle" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../pineapple-svgrepo-com.png" alt="svg ananas" id="svgpineapple">
      PineapplePizza
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Nos Stats</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ingredients
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="ingredientsliste.php">Liste des ingredients</a></li>
            <li><a class="dropdown-item" href="../ingredientsajouter.php">Ajouter un ingredient</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pizzas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="pizzaliste.php">Liste des pizzas</a></li>
            <li><a class="dropdown-item" href="pizzaajouter.php">Créer une pizza</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Commandes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="commandeliste.php">Liste des commandes</a></li>
            <li><a class="dropdown-item" href="commandeajouter.php">Créer une commande</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Client
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="clientliste.php">Liste des clients</a></li>
            <li><a class="dropdown-item" href="clientajouter.php">Créer un client</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    
