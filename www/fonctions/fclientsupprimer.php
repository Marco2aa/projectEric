<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/autoload.php");

$id_client = $_GET['id'];
$clients = Client::find($_GET['id']);
$clients->delete();

header("Location: ../clientliste.php");