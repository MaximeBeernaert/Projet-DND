<?php

class ObjetsDAO{
    private $db;

    public function __construct($db){
        $this->db = $db
    }

    public function getObjets(){
        $sql = 'SELECT * FROM objet';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $monstres = $requete->fetchAll()
        return $monstres;
    }

    public function getMonstre($id){
        $sql = 'SELECT * FROM objet WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

        $monstre = $requete->fetch();
        return $monstre;
    }
}


?>