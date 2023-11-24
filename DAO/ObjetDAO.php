<?php

class ObjetDAO {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    // this function get all the objects in the database
    public function getObjets(){
        $sql = 'SELECT * FROM objet';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $objets = $requete->fetchAll();
        return $objets;
    }
    // this function get all the objects in the database
    public function getObjet($id){
        $sql = 'SELECT * FROM objet WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

        $objet = $requete->fetch();
        return $objet;
    }
    // this function add an object in the database
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

    // SELECT o.* FROM objet o JOIN porter p ON o.id = p.idObj JOIN personnage pers ON p.idPerso = pers.id WHERE o.isConsumable = 1 AND pers.id = [ID_DU_PERSONNAGE];
        // this function get all the consumable objects of a character
    public function getObjetsConsummablesByPersonnage($idPerso){
        $sql = 'SELECT o.* FROM objet o JOIN porter p ON o.id = p.idObj JOIN personnage pers ON p.idPerso = pers.id WHERE o.isConsumable = 1 AND pers.id = :idPerso';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('idPerso' => $idPerso));

        $objets = $requete->fetchAll();
        return $objets;
    }

    // this function update an object in the database
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
    // this function delete an object in the database
    public function deleteObjet($id){
        $sql = 'DELETE FROM objet WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));
    }
}


?>