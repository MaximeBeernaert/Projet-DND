<?php
class PersonnageDAO {
private $db;

    public function __construct($db){
        $this->db = $db;
    }
    // this function return a personnage with the id
    public function getPersonnage($id){
        $req = $this->db->prepare('SELECT * FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
        $donnees = $req->fetch();
        return $donnees;
    }
    // this function get the level of the personnage with the id
    public function getPersonnageNiveau($id){
        $req = $this->db->prepare('SELECT level FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
        $donnees = $req->fetchAll()[0][0];
        return $donnees;
    }
    // this function get all the personnages
    public function getPersonnages(){
        $personnages = array();
        $req = $this->db->prepare('SELECT * FROM personnage');
        $req->execute();
        while ($donnees = $req->fetch()){
            $personnages[] = $donnees;
        }
        return $personnages;
    }
    // this function get the name of the last personnage
    public function getLastPersonnageId(){
        $req = $this->db->prepare('SELECT MAX(id) FROM personnage');
        $req->execute();
        $donnees = $req->fetch();
        return $donnees;
    }
    // this function add a personnage
    public function addPersonnage($personnage){
        $req = $this->db->prepare('INSERT INTO personnage(nom, pv, atk, def, exp, level, maxpv, maxdef, maxatk) VALUES(:name, :pv, :atk, :def, :exp, :level, :maxpv, :maxdef, :maxatk)');
        $req->execute(array(
            'name' => $personnage->getName(),
            'pv' => $personnage->getPv(),
            'atk' => $personnage->getAtk(),
            'def' => $personnage->getDef(),
            'exp' => $personnage->getExp(),
            'level' => $personnage->getLevel(),
            'maxpv' => $personnage->getMaxpv(),
            'maxdef' => $personnage->getMaxdef(),
            'maxatk' => $personnage->getMaxatk()
        ));
    }
    // this function update the Personnage status
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
    // this function delete a personnage
    public function deletePersonnage($id){
        $sql = 'DELETE FROM personnage WHERE id = :id';
        $requete = $this->db->prepare($sql);
        $requete->execute(array('id' => $id));

    }
}
    

?>