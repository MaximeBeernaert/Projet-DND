<?php
class Enigme {
    protected $intitule;
    protected $reponse;

    public function __construct($intitule,$reponse){
        $this->intitule = $intitule;
        $this->reponse = $reponse;
    }

    public function getIntitule(){
        return $this->intitule;
    }
    public function getReponse(){
        return $this->reponse;
    }

    public function setIntitule($intitule){
        $this->intitule = $intitule;
    }
    public function setReponse($reponse){
        $this->reponse = $reponse;
    }


}

?>