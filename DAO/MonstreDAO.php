<?php

class MonstreDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllMonstres(){
        $sql = 'SELECT * FROM monstre';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $monstres = $requete->fetchAll()
        return $monstres;
    }

    public function getMonstre($id){
        $sql = 'SELECT * FROM monstre WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

        $monstre = $requete->fetch();
        return $monstre;
    }

    public function addMonstre($monstre){
        $sql = 'INSERT INTO monstre(nom, pv, atk, descAtk, def, exp) VALUES(:nom, :pv, :atk, :descAtk, :def, :exp)';
        $requete = $this->db->prepare($sql);
        $requete->execute(array(
            'nom' => $monstre->getNom(),
            'pv' => $monstre->getPv(),
            'atk' => $monstre->getAtk(),
            'descAtk' => $monstre->getDescAtk(),
            'def' => $monstre->getDef(),
            'exp' => $monstre->getExp()
        ));
    }

    public function updateMonstre($id, $monstre){
        $sql = 'UPDATE monstre SET nom = :nom, pv = :pv, atk = :atk, descAtk = :descAtk, def = :def, exp = :exp WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array(
            'nom' => $monstre->getNom(),
            'pv' => $monstre->getPv(),
            'atk' => $monstre->getAtk(),
            'descAtk' => $monstre->getDescAtk(),
            'def' => $monstre->getDef(),
            'exp' => $monstre->getExp(),
            'id' => $id
        ));
    }

    public function deleteMonstre($id){
        $sql = 'DELETE FROM monstre WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));
    }

}


?>