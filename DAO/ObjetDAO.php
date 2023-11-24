<?php

class ObjetDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getObjets(){
        $sql = 'SELECT * FROM objet';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $objets = $requete->fetchAll();
        return $objets;
    }

    public function getObjet($id){
        $sql = 'SELECT * FROM objet WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

        $objet = $requete->fetch();
        return $objet;
    }

    public function addObjet($objet){
        $sql = 'INSERT INTO objet(nom, desc, heal, atk, def, dodge) VALUES(:nom, :prix, :desc, :heal, :atk, :def, :dodge)';
        $requete = $this->db->prepare($sql);
        $requete->execute(array(
            'nom' => $objet->getNom(),
            'desc' => $objet->getDesc(),
            'heal' => $objet->getHeal(),
            'atk' => $objet->getAtk(),
            'def' => $objet->getDef(),
            'dodge' => $objet->getDodge()
        ));
    }

    public function updateObjet($id, $objet){
        $sql = 'UPDATE objet SET nom = :nom, desc = :desc, heal = :heal, atk = :atk, def = :def, dodge = :dodge WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array(
            'nom' => $objet->getNom(),
            'desc' => $objet->getDesc(),
            'heal' => $objet->getHeal(),
            'atk' => $objet->getAtk(),
            'def' => $objet->getDef(),
            'dodge' => $objet->getDodge(),
            'id' => $id
        ));
    }

    public function deleteObjet($id){
        $sql = 'DELETE FROM objet WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));
    }
}


?>