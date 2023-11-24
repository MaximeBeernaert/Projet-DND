<?php
// CREATE CLASS PORTER
class Porter {
    protected $idPerso;
    protected $idObj;

    // CREATE CONSTRUCTOR
    public function __construct($idPerso, $idObj){
        $this->idPerso = $idPerso;
        $this->idObj = $idObj;
    }

    // GETTER
    public function getIdPerso(){
        return $this->idPerso;
    }

    public function getIdObj(){
        return $this->idObj;
    }

    // SETTER
    public function setIdPerso($idPerso){
        $this->idPerso = $idPerso;
    }

    public function setIdObj($idObj){
        $this->idObj = $idObj;
    }
}


?>