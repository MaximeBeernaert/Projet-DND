<?php
class Personnage {
    protected $name;
    protected $pv = 100;
    protected $atk = 10;
    protected $def = 10;
    protected $exp = 0;
    protected $level = 1;

    public function __construct($name){
        $this->name = $name;
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