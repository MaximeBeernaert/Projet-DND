<?php

class Porter {
    protected $idPerso;
    protected $idObj;

    public function __construct($idPerso, $idObj){
        $this->idPerso = $idPerso;
        $this->idObj = $idObj;
    }

    public function getIdPerso(){
        return $this->idPerso;
    }

    public function getIdObj(){
        return $this->idObj;
    }

    public function setIdPerso($idPerso){
        $this->idPerso = $idPerso;
    }

    public function setIdObj($idObj){
        $this->idObj = $idObj;
    }
}


?>