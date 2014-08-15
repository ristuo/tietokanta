<?php

class nosto {
    private $laji;
    private $tulos;
    private $hnro;
    private $kilnro;
    private $painoluokka;
    private $jarjestysnumero;
    private $kilpailunnimi;

    
    public function __construct() {
        $this->laji = null;
        $this->tulos = null;
        $this->jarjestysnumero = null;
        $this->kilnro = null;
        $this->hnro = null;
        $this->painoluokka = null;
        $this->kilpailunnimi = null;
    }
    
    public function getLaji() {
        return $this->laji;
    }
    
    public function getKilpailunnimi() {
        return $this->kilpailunnimi;
    }
    
    public function getHnro() {
        return $this->hnro;
    }
    
    public function getKilnro(){
        return $this->kilnro;
    }
    
    public function getPainoluokka() {
        return $this->painoluokka;
    }
    
    public function getTulos() {
        return $this->tulos;
    }
    
    public function getJarjestysnumero() {
        return $this->jarjestysnumero;
    }
    
    public function setJarjestysnumero($jarjestysnumero) {
        $this->jarjestysnumero = $jarjestysnumero;
    }
    
    public function setLaji($laji) {
        $this->laji = $laji;
    }
    
    public function setHnro($hnro) {
        $this->hnro = $hnro;
    }
    
    public function setKilnro($kilnro) {
        $this->kilnro = $kilnro;
    }
    
    public function setPainoluokka($painoluokka) {
        $this->painoluokka = $painoluokka;
    }
    
    public function setTulos($tulos) {
        $this->tulos = $tulos;
    }
    
    public function setKilpailunnimi($nimi) {
        $this->kilpailunnimi = $nimi;
    }
    
    public static function haeNostajanNostotLajissa($hnro, $laji) {
        $sql = "SELECT nosto.tulos as tulos, nosto.jarjestysnumero as jarjestysnumero,"
                . " kilpailu.nimi as nimi, nosto.laji as laji, nosto.painoluokka as painoluokka"
                . " FROM nosto INNER JOIN kilpailu ON (nosto.kilnro = kilpailu.kilnro) WHERE hnro =".$hnro."AND laji='".$laji."' ORDER BY tulos";
        $tulos = toteutaKysely($sql);        
        if ($tulos == null) {
            return null;
        }        
        $palautettava = array();
        $i = 1;
        foreach($tulos as $rivi) {
            $lisattava = new nosto();
            $lisattava->setTulos($rivi->tulos);
            $lisattava->setJarjestysnumero($rivi->jarjestysnumero);
            $lisattava->setKilpailunnimi($rivi->nimi);
            $lisattava->setLaji($rivi->laji);
            $lisattava->setPainoluokka($rivi->painoluokka);
            
            $palautettava[$i] = $lisattava;
            $i++;
        }        
        return $palautettava;
    }
    
    
}