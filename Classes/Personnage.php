<?php
class Personnage {
    protected $name;
    protected $pv = 100;
    protected $atk = 10;
    protected $def = 10;
    protected $exp = 0;
    protected $expNext = 0; // ? c'est quoi?
    protected $level = 1;
    protected $id;
    protected $maxpv;
    protected $maxdef;
    protected $maxatk;
    protected $dodge = 0;
    protected $isDefending;

    public function __construct($name, $pv, $atk, $def, $exp, $level, $maxpv, $maxdef, $maxatk){
        $this->name = $name;
        $this->maxpv = $this->pv;
        $this->maxdef = $this->def;
        $this->maxatk = $this->atk;
        $this->isDefending = false;
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
    public function getExpNext(){
        return $this->expNext;
    }
    public function getLevel(){
        return $this->level;
    }
    public function getId(){
        return $this->id;
    }
    public function getMaxpv(){
        return $this->maxpv;
    }
    public function getMaxdef(){
        return $this->maxdef;
    }
    public function getMaxatk(){
        return $this->maxatk;
    }
    public function getDodge(){
        return $this->dodge;
    }
    public function getIsDefending(){
        return $this->isDefending;
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
    public function setExpNext($expNext){
        $this->exp = $expNext;
    }
    public function setLevel($level){
        $this->level = $level;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setMaxpv($maxpv){
        $this->maxpv = $maxpv;
    }
    public function setMaxdef($maxdef){
        $this->maxdef = $maxdef;
    }
    public function setMaxatk($maxatk){
        $this->maxatk = $maxatk;
    }
    public function setDodge($dodge){
        $this->dodge = $dodge;
    }
    public function setIsDefending($isDefending){
        $this->isDefending = $isDefending;
    }
}


?>