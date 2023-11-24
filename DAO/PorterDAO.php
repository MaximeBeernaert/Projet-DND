<?php
class PorterDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    // this function return all inventory's objects
    public function getPorterByPersonnage($idPerso){
        $sql = 'SELECT * FROM porter WHERE idPerso = :idPerso';
        $req = $this->db->prepare($sql);
        $req->bindValue(':idPerso', $idPerso, PDO::PARAM_INT);
        $req->execute();

        $donnees = $req->fetch();
        return $donnees;
    }
    // add inventory's object in database
    public function addPorter($porter){
        $sql = 'INSERT INTO porter(idPerso, idObj) VALUES(:idPerso, :idObj)';
        $req = $this->db->prepare($sql);
        $req->bindValue(':idPerso', $porter->getIdPerso(), PDO::PARAM_INT);
        $req->bindValue(':idObj', $porter->getIdObj(), PDO::PARAM_INT);
        $req->execute();
    }
    // update inventory's object in database
    public function updatePorter($porter){
        $sql = 'UPDATE porter SET idPerso = :idPerso, idObj = :idObj WHERE idPerso = :idPerso';
        $req = $this->db->prepare($sql);
        $req->bindValue(':idPerso', $porter->getIdPerso(), PDO::PARAM_INT);
        $req->bindValue(':idObj', $porter->getIdObj(), PDO::PARAM_INT);
        $req->execute();
    }
    // delete inventory's object in database
    public function deletePorter($idPerso){
        $sql = 'DELETE FROM porter WHERE idPerso = :idPerso';
        $req = $this->db->prepare($sql);
        $req->bindValue(':idPerso', $idPerso, PDO::PARAM_INT);
        $req->execute();
    }

}


?>