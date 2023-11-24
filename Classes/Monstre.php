<?php

// CREATE CLASS
// CREATE CLASS
class Monstre {
    private $nom;
    private $pv;
    private $atk;
    private $descAtk;
    private $def;
    private $exp;
    private $poisoned = 0;
    private $isDefending = false;
    private $isDefending = false;

    // CREATE CONSTRUTOR
    // CREATE CONSTRUTOR
    public function __construct($nom, $pv, $atk, $descAtk, $def, $exp){
        $this->nom = $nom;
        $this->pv = $pv;
        $this->atk = $atk;
        $this->descAtk = $descAtk;
        $this->def = $def;
        $this->exp = $exp;
    }

    // GETTER
    public function getNom(){
        return $this->nom;
    }

    public function getPv(){
        return $this->pv;
    }

    public function getAtk(){
        return $this->atk;
    }

    public function getDescAtk(){
        return $this->descAtk;
    }

    public function getDef(){
        return $this->def;
    }

    public function getExp(){
        return $this->exp;
    }

    public function getPoisoned(){
        return $this->poisoned;
    }

    public function getIsDefending(){
        return $this->isDefending;
    }



    // SETTER
    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPv($pv){
        $this->pv = $pv;
    }

    public function setAtk($atk){
        $this->atk = $atk;
    }

    public function setDescAtk($descAtk){
        $this->descAtk = $descAtk;
    }

    public function setDef($def){
        $this->def = $def;
    }

    public function setExp($exp){
        $this->exp = $exp;
    }

    public function setPoisoned($poisoned){
        $this->poisoned = $poisoned;
    }

    public function setIsDefending($isDefending){
        $this->isDefending = $isDefending;
    }

}
?>