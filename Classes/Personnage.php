<?php
class Personnage {
    protected $name;
    protected $pv;
    protected $atk;
    protected $def;
    protected $exp;
    protected $level;

    public function __construct($name, $pv, $atk, $def, $exp, $level){
        $this->name = $name;
        $this->pv = $pv;
        $this->atk = $atk;
        $this->def = $def;
        $this->exp = $exp;
        $this->level = $level;
    }

    // GETTER
    public function getName(){
        return $this->name;
    }
    public function getPv(){
        return $this->pv;
    }
    public function getAtk(){
        return $this->atk;
    }
    public function getdef(){
        return $this->def;
    }
    public function getExp(){
        return $this->exp;
    }
    public function getLevel(){
        return $this->level;
    }


    // SETTER
    public function setName($name){
        $this->name = $name;
    }

    public function setPv($pv){
        $this->pv = $pv;
    }

    public function setAtk($atk){
        $this->atk = $atk;
    }

    public function setDef($def){
        $this->def = $def;
    }

    public function setExp($exp){
        $this->exp = $exp;
    }

    public function setLevel($level){
        $this->level = $level;
    }


}


?>