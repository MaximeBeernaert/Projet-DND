<?php

class Monstre {
    private $nom;
    private $pv;
    private $atk;
    private $descAtk;
    private $def;
    private $exp;

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
}



?>