<?php

class Client {
    private $id_client;
    private $nom;

    public function __construct($nom) {
        $this->setNomClient($nom);
    }

    public static function findAll() {
        $stmt = DB::getConnection()->query("SELECT * FROM client");
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $client = new Client($row['nom']);
            $client->id_client = $row['id_client']; 
            $clients[] = $client;
        }
        return $clients;
    }

    public static function find($id) {
        $stmt = DB::getConnection()->prepare("SELECT * FROM client WHERE id_client=:id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $client = new Client($row['nom']);
        $client->id_client = $row['id_client'];
 
        return $client;
    }

    public function save() {
        if (is_null($this->id_client)) {
            $stmt = DB::getConnection()->prepare(
                "INSERT INTO client(nom) VALUES(:nom)"
            );
            $stmt->execute([
                ':nom' => $this->getNomClient()
            ]);
            $this->id_client = DB::getConnection()->lastInsertId();
        } else {
            $stmt = DB::getConnection()->prepare(
                "UPDATE client SET nom=:nom WHERE id_client=:id"
            );
            $stmt->execute([
                ':nom' => $this->getNomClient(),
                ':id' => $this->getId()
            ]);
        }
    }

    public function delete() {
        $stmt = DB::getConnection()->prepare("DELETE FROM pizzaCommande
                                              WHERE id_commande 
                                              IN (SELECT id 
                                                  FROM commande 
                                                  WHERE id_client = :id_client)");
        $stmt->execute([':id_client' => $this->id_client]);
        $stmt = DB::getConnection()->prepare("DELETE FROM commande WHERE id_client = :id_client");
        $stmt->execute([':id_client' => $this->id_client]);
        $stmt = DB::getConnection()->prepare("DELETE FROM client WHERE id_client = :id_client");
        $stmt->execute([':id_client' => $this->id_client]);
    }
    
    

    public function getId() {
        return $this->id_client;
    }


    public function getNomClient() {
        return $this->nom;
    }

    public function setNomClient($nom) {
        $this->nom = $nom;
    }

    public static function findLeGlouton() {
        $stmt = DB::getConnection()->query("
            SELECT client.nom AS nom_client, COUNT(pizzaCommande.id_pizza) as total
            FROM client 
            JOIN commande  ON client.id_client = commande.id_client
            JOIN pizzaCommande  ON commande.id = pizzaCommande.id_commande
            GROUP BY client.id_client
            ORDER BY total DESC
            LIMIT 1
        ");
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $client = new Client($row['nom_client']);
            return $client;
        } else {
            return null; 
        }
    }
}



?>
