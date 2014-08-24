<?php

class nostaja {

    private $nimi;
    private $kansallisuus;
    private $seura;
    private $syntymavuosi;
    private $sukupuoli;
    private $hnro;
    private $virheet;
    
    public function __construct() {
        $this->nimi = null;
        $this->kansallisuus = null;
        $this->seura = null;
        $this->svuosi = null;
        $this->sukupuoli = null;
        $this->hnro = null;
        $this->virheet = array();
    }
    
    public function setNimi($nimi){
        $this->nimi=$nimi;
        
        if (trim($this->nimi)=='') {
            $this->virheet['nimi']="Nimi ei saa olla tyhjä";
        }
        
        if (strlen($this->nimi)>100) {
            $this->virheet['nimi']="Nimi voi olla enintään 100 merkkiä pitkä";
        }
        
        if (trim($this->nimi)!='' && strlen($this->nimi<=100)) {
            unset($this->virheet['nimi']);
        }
    }
    
    public function setKansallisuus($kansallisuus) {
        $this->kansallisuus=$kansallisuus;
    }
    
    public function setSeura($seura) {
        $this->seura=$seura;
        if (strlen($this->seura)>50) {
            $this->virheet['seura']="Seuran nimi ei voi olla yli 50 merkkiä pitkä";
        }
    }
    
    public function setSukupuoli($sukupuoli){
        $this->sukupuoli=$sukupuoli;
        
    }

    public function setSvuosi($svuosi) {
        /*
        if (!preg_match("/^[0-9]{4}-[0-12]-[0-31]$/", $svuosi)) {
            $this->virheet['syntymapaiva']="Syntymäpäivän tulee olla muodossa YYYY-MM-DD";
        }
        else { 
            unset($this->virheet['syntymapaiva']);
            $this->svuosi = $svuosi; 
            }; 
         */
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
        $sql = "select hnro, nimi, kansalaisuus, seura, extract(year from syntymapaiva) as syntymavuosi, sukupuoli from nostaja";
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
            $lisattava->setKansallisuus($rivi->kansalaisuus);
            
            $palautettava[$rivi->hnro] = $lisattava;
        }
        return $palautettava;
    }

    public static function haeSukupuolenPerusteella($sukupuoli) {
        $sql = "select hnro, nimi, kansalaisuus, seura, sukupuoli, extract(year from syntymapaiva)"
                . " as syntymavuosi from nostaja where sukupuoli = '".$sukupuoli."'";
        $tulos = nostaja::toteutaKysely($sql);
        if ($tulos==null){
            return null;
        }
        
        return nostaja::muodostaArray($tulos);
    
    }

    

    public static function haeNostajaNumerolla($hnro) {
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
        $palautettava->setKansallisuus($tulos->kansalaisuus);
        $palautettava->setSeura($tulos->seura);
        $palautettava->setSvuosi($tulos->syntymavuosi);
        $palautettava->setSukupuoli($tulos->sukupuoli);
        return $palautettava;
        
    }
    
    public function lisaaNostaja() {
        $sql = "INSERT INTO nostaja(nimi, kansalaisuus, syntymapaiva, sukupuoli, seura) VALUES(?,?,?,?,?)"
                . " RETURNING hnro";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $tiedot = array($this->getNimi(),$this->getKansallisuus(),$this->getSvuosi(),$this->getSukupuoli(),$this->getSeura());
        
        $ok = $kysely->execute($tiedot);
        if ($ok) {
            $this->hnro = $kysely->FetchColumn();
        }
        return $this->hnro;
    }
                
    public function getVirheet() {
        return $this->virheet;
    }
    
    public function onkoKelvollinen() { /*
        foreach ($this->virheet as $virhe) {
            if ($virhe!=null) {
                return false;
            }
        }
        return true;
        *
     * 
     */
        return empty($this->virheet);
        
        
    }

    
    public static function haeNostajatNimella($nimi) {
        $sql = "select hnro, nimi, kansalaisuus,"
                . " seura, extract(year from syntymapaiva) as syntymavuosi,"
                . " sukupuoli from nostaja where nimi = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        if ($tulos==null){
            return null;
        }
        return nostaja::muodostaArray($tulos);
    }

    public function muokkaa() {
        $sql = "UPDATE nostaja SET nimi = ?, kansalaisuus = ?, syntymapaiva = ?, seura = ?, sukupuoli = ?"
                . "WHERE hnro = ? ";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tiedot = array($this->getNimi(), $this->getKansallisuus(), $this->getSvuosi(), $this->getSeura(), $this->getSukupuoli(), $this->getHnro());
        $ok = $kysely->execute($tiedot);        
        return $ok;
        }
    
    public function poista() {
        $sql = "DELETE FROM nostaja WHERE hnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $tiedot = array($this->getHnro());
        $kysely->execute($tiedot);
    }    
        
}