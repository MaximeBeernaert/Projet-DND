<?php
// CREATE CLASS COMP
class Competence {
    protected $nom;
    protected $desc;
    protected $heal;
    protected $atk;
    protected $niveauMinimum;

    // CREATE CONSTRUCTOR
    public function __construct($nom, $desc, $heal, $atk, $niveauMinimum){
        $this->nom = $nom;
        $this->desc = $desc;
        $this->heal = $heal;
        $this->atk = $atk;
        $this->niveauMinimum = $niveauMinimum;
    }

    // GETTER
    public function getNom(){
        return $this->nom;
    }

    public function getDesc(){
        return $this->desc;
    }

    public function getHeal(){
        return $this->heal;
    }

    public function getAtk(){
        return $this->atk;
    }

    public function getNiveauMinimum(){
        return $this->niveauMinimum;
    }


    // SETTER

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setDesc($desc){
        $this->desc = $desc;
    }

    public function setHeal($heal){
        $this->heal = $heal;
    }

    public function setAtk($atk){
        $this->atk = $atk;
    }

    public function setNiveauMinimum($niveauMinimum){
        $this->niveauMinimum = $niveauMinimum;
    }
}


?>