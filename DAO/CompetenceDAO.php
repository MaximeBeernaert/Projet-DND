<?php

class CompetenceDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getCompetence($id){
        $sql = "SELECT * FROM competence WHERE id = :id";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $competence = $requete->fetchAll();
        return $competence;
    }

    public function getCompetences(){
        $sql = "SELECT * FROM competence";
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $competence = $requete->fetchAll();
        return $competence;
    }

    public function getCompetencesByNiveauMinimum($lvl){
        $sql = "SELECT * FROM competence WHERE lvl = :lvl";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':lvl', $lvl);
        $requete->execute();
        $competences = $requete->fetchAll();
        return $competences;
    }

    public function addCompetence($competence){
        $sql = "INSERT INTO competence(nom, desc, atk, heal) VALUES (:nom, :desc, :atk, :heal)";
        $req = $this->db->prepare($sql);
        $req->bindValue(':nom', $competence->getNom());
        $req->bindValue(':desc', $competence->getDesc());
        $req->bindValue(':atk', $competence->getAtk());
        $req->bindValue(':heal', $competence->getHeal());
        $req->execute();
        $req->closeCursor();
    }

    public function updateCompetence($competence){
        $sql = "UPDATE competence SET nom = :nom, desc = :desc, atk = :atk, heal = :heal WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':nom', $competence->getNom());
        $req->bindValue(':desc', $competence->getDesc());
        $req->bindValue(':atk', $competence->getAtk());
        $req->bindValue(':heal', $competence->getHeal());
        $req->bindValue(':id', $competence->getId());
        $req->execute();
        $req->closeCursor();
    }

    public function deleteCompetence($id){
        $sql = "DELETE FROM competence WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id);

    }
}


?>