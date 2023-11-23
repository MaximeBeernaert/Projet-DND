<?php

class SalleDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addSalle($salle){
        $req = $this->db->prepare('INSERT INTO salle (id, nom, description, id_monstre, id_objet) VALUES (:id, :nom, :description, :id_monstre, :id_objet)');
        $req->bindValue(':id', $salle->getId(), PDO::PARAM_INT);
        $req->bindValue(':nom', $salle->getNom(), PDO::PARAM_STR);
        $req->bindValue(':description', $salle->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':id_monstre', $salle->getIdMonstre(), PDO::PARAM_INT);
        $req->bindValue(':id_objet', $salle->getIdObjet(), PDO::PARAM_INT);
        $req->execute();
    }

    public function deleteSalle($salle){
        $req = $this->db->prepare('DELETE FROM salle WHERE id = :id');
        $req->bindValue(':id', $salle->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function updateSalle($salle){
        $req = $this->db->prepare('UPDATE salle SET nom = :nom, description = :description, id_monstre = :id_monstre, id_objet = :id_objet WHERE id = :id');
        $req->bindValue(':id', $salle->getId(), PDO::PARAM_INT);
        $req->bindValue(':nom', $salle->getNom(), PDO::PARAM_STR);
        $req->bindValue(':description', $salle->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':id_monstre', $salle->getIdMonstre(), PDO::PARAM_INT);
        $req->bindValue(':id_objet', $salle->getIdObjet(), PDO::PARAM_INT);
        $req->execute();
    }

    public function getSalle($id){
        $req = $this->db->prepare('SELECT * FROM salle WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        return new Salle($donnees['id'], $donnees['nom'], $donnees['description'], $donnees['id_monstre'], $donnees['id_objet']);
    }
}




?>