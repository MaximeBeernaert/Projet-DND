<?php

class Objet {
    protected $nom;
    protected $desc;
    protected $heal;
    protected $atk;
    protected $def;
    protected $dodge;
    protected $isConsumable;

    public function __construct($nom, $desc, $heal, $atk, $def, $dodge, $isConsumable){
        $this->nom = $nom;
        $this->desc = $desc;
        $this->heal = $heal;
        $this->atk = $atk;
        $this->def = $def;
        $this->dodge = $dodge;
        $this->isConsumable = $isConsumable;
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

    public function getDef(){
        return $this->def;
    }

    public function getDodge(){
        return $this->dodge;
    }
    
    public function getIsConsumable(){
        return $this->isConsumable;
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

    public function setDef($def){
        $this->def = $def;
    }

    public function setDodge($dodge){
        $this->dodge = $dodge;
    }

    public function setIsConsumable($isConsumable){
        $this->isConsumable = $isConsumable;
    }
}


?>