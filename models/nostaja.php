<?php

class nostaja {

    private $nimi;
    private $kansallisuus;
    private $seura;
    private $syntymavuosi;
    private $sukupuoli;
    private $hnro;
    
    
    public function __construct() {
        $this->nimi = null;
        $this->kansallisuus = null;
        $this->seura = null;
        $this->svuosi = null;
        $this->sukupuoli = null;
        $this->hnro = null;
    }
    
    public function setNimi($nimi){
        $this->nimi=$nimi;
    }
    
    public function setKansallisuus($kansallisuus) {
        $this->kansallisuus=$kansallisuus;
    }
    
    public function setSeura($seura) {
        $this->seura=$seura;
    }
    
    public function setSukupuoli($sukupuoli){
        $this->sukupuoli=$sukupuoli;
    }

    public function setSvuosi($svuosi) {
        $this->svuosi = $svuosi;
    }
    
    public function setHnro($hnro) {
        $this->hnro=$hnro;
    }
    
    public function getNimi() {
        return $this->nimi;
    }
    
    public function getHnro() {
        return $this->hnro;
    }
    
    public function getSukupuoli() {
        return $this->sukupuoli;
    }
    
    public function getSvuosi() {
        return $this->svuosi;
    }
    
    public function getSeura() {
        return $this->seura;
    }
    
    public function getKansallisuus() {
        return $this->kansallisuus;
    }

    function toteutaKysely($sql) {
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function test() {
        
    }
    
    public static function haeKaikkiNostajat() {
        $sql = "select hnro, nimi, kansalaisuus, seura, extract(year from syntymapaiva) as syntymavuosi from nostaja";
        $tulos = nostaja::toteutaKysely($sql); 
        if ($tulos==null) {
            return null;
        }
        
        return nostaja::muodostaArray($tulos);
    }

    

    function muodostaArray($aineisto) {
        $palautettava = array();
        
        foreach($aineisto as $rivi) {
            $lisattava = new nostaja();
            
            $lisattava->setHnro($rivi->hnro);
            $lisattava->setNimi($rivi->nimi);
            $lisattava->setSvuosi($rivi->syntymavuosi);
            $lisattava->setSeura($rivi->seura);
            $lisattava->setSukupuoli($rivi->sukupuoli);
            $lisattava->setKansallisuus($rivi->kansallisuus);
            
            $palautettava[$rivi->hnro] = $lisattava;
        }
        return $palautettava;
    }

    public static function haeSukupuolenPerusteella($sukupuoli) {
        $sql = "select hnro, nimi, kansalaisuus, seura, extract(year from syntymapaiva)"
                . " as syntymavuosi from nostaja where sukupuoli = '".$sukupuoli."'";
        $tulos = nostaja::toteutaKysely($sql);
        if ($tulos==null){
            return null;
        }
        
        return nostaja::muodostaArray($tulos);
    
    }

    

    function haeNostajaNumerolla($hnro) {
        $sql = "select hnro, nimi, kansalaisuus,"
                . " seura, extract(year from syntymapaiva) as syntymavuosi,"
                . " sukupuoli from nostaja where hnro =".$hnro ."LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchObject();
        
        if ($tulos==null) {
            return null;
        } 
        
        $palautettava = new nostaja();
        $palautettava->setHnro($tulos->hnro);
        $palautettava->setNimi($tulos->nimi);
        $palautettava->setKansallisuus($tulos->kansallisuus);
        $palautettava->setSeura($tulos->seura);
        $palautettava->setSvuosi($tulos->syntymavuosi);
        $palautettava->setSukupuoli($tulos->sukupuoli);
        return $palautettava;
        
    }   

}