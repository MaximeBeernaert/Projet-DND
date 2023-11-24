<?php
class Utiliser {
    protected $idPerso;
    protected $idCom;

    public function __construct($idPerso, $idCom){
        $this->idPerso = $idPerso;
        $this->idCom = $idCom;
    }

    public function getIdPerso(){
        return $this->idPerso;
    }

    public function getidCom(){
        return $this->idCom;
    }

    public function setIdPerso($idPerso){
        $this->idPerso = $idPerso;
    }

    public function setIdCom($idCom){
        $this->idCom = $idCom;
    }
}


?>