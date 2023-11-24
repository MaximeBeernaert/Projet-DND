<?php

class EnigmeDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getEnigme($id){
        $sql = "SELECT * FROM enigme WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id);
        $req->execute();
        $enigme = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        $enigme = new Enigme($enigme->intitule, $enigme->reponse);
        return $enigme;
    }

    public function getEnigmes(){
        $sql = "SELECT * FROM enigme";
        $req = $this->db->prepare($sql);
        $req->execute();
        while($enigme = $req->fetch(PDO::FETCH_OBJ)){
            $enigmes[] = new Enigme($enigme->intitule, $enigme->reponse);
        }
        $req->closeCursor();
        return $enigmes;
    }

    public function addEnigme($enigme){
        $sql = "INSERT INTO enigme(intitule, reponse) VALUES (:intitule, :reponse)";
        $req = $this->db->prepare($sql);
        $req->bindValue(':intitule', $enigme->getIntitule());
        $req->bindValue(':reponse', $enigme->getReponse());
        $req->execute();
        $req->closeCursor();
    }

    public function updateEnigme($enigme){
        $sql = "UPDATE enigme SET intitule = :intitule, reponse = :reponse WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':intitule', $enigme->getIntitule());
        $req->bindValue(':reponse', $enigme->getReponse());
        $req->bindValue(':id', $enigme->getId());
        $req->execute();
        $req->closeCursor();
    }

    public function deleteEnigme($id){
        $sql = "DELETE FROM Enigme WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id);

    }
}

?>