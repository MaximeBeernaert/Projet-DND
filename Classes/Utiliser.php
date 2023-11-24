<?php
// CREATE CLASS UTILISER
class Utiliser {
    protected $idPerso;
    protected $idCom;

    // CREATE CONSTRUCTOR
    public function __construct($idPerso, $idCom){
        $this->idPerso = $idPerso;
        $this->idCom = $idCom;
    }

    // GETTER
    public function getIdPerso(){
        return $this->idPerso;
    }

    public function getidCom(){
        return $this->idCom;
    }

    // SETTER
    public function setIdPerso($idPerso){
        $this->idPerso = $idPerso;
    }

    public function setIdCom($idCom){
        $this->idCom = $idCom;
    }
}


?>