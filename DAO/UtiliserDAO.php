<?php

class UtiliserDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getUtiliser($idPerso){
        $sql = "SELECT * FROM utiliser WHERE idPerso = :idPerso";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idPerso", $idPerso, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_CLASS, "Utiliser");
        return $res;
    }

    public function addUtiliser($utiliser){
        $sql = "INSERT INTO utiliser(idPerso, idObj) VALUES (:idPerso, :idObj)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idPerso", $utiliser->getIdPerso(), PDO::PARAM_INT);
        $stmt->bindValue(":idObj", $utiliser->getIdObj(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateUtiliser($utiliser){
        $sql = "UPDATE utiliser SET idPerso = :idPerso, idObj = :idObj WHERE idPerso = :idPerso";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idPerso", $utiliser->getIdPerso(), PDO::PARAM_INT);
        $stmt->bindValue(":idObj", $utiliser->getIdObj(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteUtiliser($idPerso){
        $sql = "DELETE FROM utiliser WHERE idPerso = :idPerso";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idPerso", $idPerso, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}


?>