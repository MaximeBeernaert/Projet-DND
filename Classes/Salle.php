<?php
class Salle {
    protected $niveau;
    protected $ennemie;
    protected $piege;
    protected $enigme;
    protected $marchand;

    public function __construct($niveau,$ennemie,$piege,$enigme,$marchand){
        $this->niveau = $niveau;
        $this->ennemie = $ennemie;
        $this->piege = $piege;
        $this->enigme = $enigme;
        $this->marchand = $marchand;
    }

    public function getNiveau(){
        return $this->niveau;
    }
    public function getEnnemie(){
        return $this->ennemie;
    }
    public function getPiege(){
        return $this->piege;
    }
    public function getEnigme(){
        return $this->enigme;
    }
    public function getMarchand(){
        return $this->marchand
    }

    public function setNiveau($niveau){
        $this->niveau = $niveau;
    }

    public function setEnnemie($ennemie){
        $this->ennemie = $ennemie;
    }

    public function setPiege($piege){
        $this->piege = $piege;
    }

    public function setEnigme($enigme){
        $this->enigme = $enigme;
    }

    public function setMarchand($marchand){
        $this->marchand = $marchand;
    }

}

?>