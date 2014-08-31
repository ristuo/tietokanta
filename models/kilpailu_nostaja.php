<?php

class kilpailu_nostaja {
    private $hnro;
    private $kilnro;
    
    public function __construct() {
        $this->hnro=null;
        $this->kilnro=null;
    }
    
    public function setHnro($hnro) {
        $this->hnro = $hnro;
    }
    public function getHnro() {
        return $this->hnro;
    }
    public function setKilnro($kilnro) {
        $this->kilnro = $kilnro;
    }
    
    public function getKilnro(){
        return $this->kilnro;
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO kilpailu_nostaja(hnro,kilnro) VALUES(".$this->getHnro().",".$this->getKilnro().")";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
    }
}