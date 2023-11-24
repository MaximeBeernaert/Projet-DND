<?php
// CREATE CLASS ENIGME
class Enigme {
    protected $intitule;
    protected $reponse;

    // CREATE CONSTRUCTOR
    public function __construct($intitule,$reponse){
        $this->intitule = $intitule;
        $this->reponse = $reponse;
    }

    // GETTER
    public function getIntitule(){
        return $this->intitule;
    }
    public function getReponse(){
        return $this->reponse;
    }

    // SETTER
    public function setIntitule($intitule){
        $this->intitule = $intitule;
    }
    public function setReponse($reponse){
        $this->reponse = $reponse;
    }


}

?>