<?php
include ('Personnage.php');
class PersonnageDAO {
private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getpersonnage($id){
        $req = $this->db->prepare('SELECT * FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
        $donnees = $req->fetch();
        return $donnees;
    }

    public function getpersonnages(){
        $personnages = array();
        $req = $this->db->prepare('SELECT * FROM personnage');
        $req->execute();
        while ($donnees = $req->fetch()){
            $personnages[] = $donnees;
        }
        return $personnages;

    }

    public function addpersonnage($personnage){
        $req = $this->db->prepare('INSERT INTO personnage(name, pv, pa, pd, xp, level,comp) VALUES(:name, :pv, :pa, :pd, :xp, :level, :comp)');
        $req->execute(array(
            'name' => $personnage->getName(),
            'pv' => $personnage->getPv(),
            'pa' => $personnage->getPa(),
            'pd' => $personnage->getPd(),
            'xp' => $personnage->getXp(),
            'level' => $personnage->getLevel(),
            'comp' => $personnage->getComp()
        ));
    }

    public function updatepersonnage($personnage){
        $req = $this->db->prepare('UPDATE personnage SET name = :name, pv = :pv, pa = :pa, pd = :pd, xp = :xp, level = :level, comp = :comp WHERE id = :id');
        $req->execute(array(
            'name' => $personnage->getName(),
            'pv' => $personnage->getPv(),
            'pa' => $personnage->getPa(),
            'pd' => $personnage->getPd(),
            'xp' => $personnage->getXp(),
            'level' => $personnage->getLevel(),
            'comp' => $personnage->getComp(),
            'id' => $personnage->getId()
        ));
    }

    public function deletepersonnage($id){
        $req = $this->db->prepare('DELETE FROM personnage WHERE id = :id');
        $req->execute(array('id' => $id));
    }

}
 $nouveauPersonnage = new PersonnageDAO($db);
?>