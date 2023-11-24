<?php
class PersonnageDAO {
private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getPersonnage($id){
        $req = $this->db->prepare('SELECT * FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
        $donnees = $req->fetch();
        return $donnees;
    }

    public function getPersonnageNiveau($id){
        $req = $this->db->prepare('SELECT niveau FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
        $donnees = $req->fetch();
        return $donnees;
    }

    public function getPersonnages(){
        $personnages = array();
        $req = $this->db->prepare('SELECT * FROM personnage');
        $req->execute();
        while ($donnees = $req->fetch()){
            $personnages[] = $donnees;
        }
        return $personnages;
    }

    public function getLastPersonnageId(){
        $req = $this->db->prepare('SELECT MAX(id) FROM personnage');
        $req->execute();
        $donnees = $req->fetch();
        return $donnees;
    }

    public function addPersonnage($personnage){
        $req = $this->db->prepare('INSERT INTO personnage(nom, pv, atk, def, exp, level, maxpv, maxdef, dodge, maxatk) VALUES(:name, :pv, :atk, :def, :exp, :level, :maxpv, :maxdef, :dodge, :maxatk)');
        $req->execute(array(
            'name' => $personnage->getName(),
            'pv' => $personnage->getPv(),
            'atk' => $personnage->getAtk(),
            'def' => $personnage->getDef(),
            'exp' => $personnage->getExp(),
            'level' => $personnage->getLevel(),
            'maxpv' => $personnage->getMaxpv(),
            'maxdef' => $personnage->getMaxdef(),
            'dodge' => $personnage->getDodge(),
            'maxatk' => $personnage->getMaxatk()
        ));
    }

    public function updatePersonnage ($id, $personnage) {
        $req = $this->db->prepare('UPDATE personnage SET nom = :name, pv = :pv, atk = :atk, def = :def, exp = :exp, level = :level WHERE id = :id');
        $req->execute(array(
            'name' => $personnage->getName(),
            'pv' => $personnage->getPv(),
            'atk' => $personnage->getAtk(),
            'def' => $personnage->getDef(),
            'exp' => $personnage->getExp(),
            'level' => $personnage->getLevel(),
            'id' => $id
        ));
        
    }

    public function deletePersonnage($id){
        $sql = 'DELETE FROM personnage WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

    }
}
    

?>