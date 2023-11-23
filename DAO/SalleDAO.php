<?php

class SalleDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addSalle($salle){
        $req = $this->db->prepare('INSERT INTO salle (id, niveau, ennemie, piege, enigme, marchand) VALUES (:id, :niveau, :ennemie, :piege, :enigme, :marchand)');
        $req->bindValue(':niveau', $salle->getNiveau(), PDO::PARAM_INT);
        $req->bindValue(':ennemie', $salle->getEnnemie(), PDO::PARAM_STR);
        $req->bindValue(':piege', $salle->getPiege(), PDO::PARAM_STR);
        $req->bindValue(':enigme', $salle->getEnigme(), PDO::PARAM_STR);
        $req->bindValue(':marchand', $salle->getMarchand(), PDO::PARAM_STR);
        $req->execute();
    }

    public function deleteSalle($salle){
        $req = $this->db->prepare('DELETE FROM salle WHERE id = :id');
        $req->bindValue(':id', $salle->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function updateSalle($salle){
        $req = $this->db->prepare('UPDATE salle SET niveau = :niveau, ennemie = :ennemie, piege = :piege, enigme = :enigme, marchand = :marchand WHERE id = :id');
        $req->bindValue(':id', $salle->getId(), PDO::PARAM_INT);
        $req->bindValue(':niveau', $salle->getNiveau(), PDO::PARAM_INT);
        $req->bindValue(':ennemie', $salle->getEnnemie(), PDO::PARAM_STR);
        $req->bindValue(':piege', $salle->getPiege(), PDO::PARAM_STR);
        $req->bindValue(':enigme', $salle->getEnigme(), PDO::PARAM_STR);
        $req->bindValue(':marchand', $salle->getMarchand(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getSalle($id){
        $req = $this->db->prepare('SELECT * FROM salle WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        return new Salle($donnees['id'], $donnees['niveau'], $donnees['ennemie'], $donnees['piege'], $donnees['enigme'], $marchand['marchand']);
    }
}
 



?>