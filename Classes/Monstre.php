<?php

class Monstre {
    private $nom;
    private $pv;
    private $atk;
    private $descAtk;
    private $def;
    private $exp;
    private $poisoned;

    public function __construct($nom, $pv, $atk, $descAtk, $def, $exp){
        $this->nom = $nom;
        $this->pv = $pv;
        $this->atk = $atk;
        $this->descAtk = $descAtk;
        $this->def = $def;
        $this->exp = $exp;
        $this->poisoned = 0;
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

    public function isPoisoned() {  
        return $this->poisoned > 0;
    }

    public function reducePoisond(){
        $this->poisoned -=1;
    }


}
?>