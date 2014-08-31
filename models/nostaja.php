<?php

class nostaja {

    private $nimi;
    private $kansallisuus;
    private $seura;
    private $svuosi;
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
        
        
        if (trim($nimi)=='') {
            $this->virheet['nimi']="Nimi ei saa olla tyhjä";
        }
        
        else if (strlen($nimi)>100) {
            $this->virheet['nimi']="Nimi voi olla enintään 100 merkkiä pitkä";
        }
        else if (preg_match('#[0-9]#',$nimi)) {
            $this->virheet['nimi']="Nimessä ei voi olla numeroita";
            
        }
        
        else {
            unset($this->virheet['nimi']);
            $this->nimi=$nimi;
            
        }
    }
    
    public function setKansallisuus($kansallisuus) {
        
        if (strlen($kansallisuus)>30) {
            $this->virheet['kansallisuus']="Kansallisuuden tulee olla alle 30 merkkiä";
        }
        
        else if (preg_match('#[0-9]#',$kansallisuus)) {
            $this->virheet['kansallisuus']="Kansallisuudessa ei voi olla numeroita";
        }
        
        else {
            $this->kansallisuus=$kansallisuus;
            unset($this->virheet['kansallisuus']);
        }
    }
    
    public function setSeura($seura) {
        
        if (strlen($this->seura)>50) {
            $this->virheet['seura']="Seuran nimi ei voi olla yli 50 merkkiä pitkä";
        }
        else {
            $this->seura=$seura;
            unset($this->virheet['seura']);
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
        
        if (preg_match('#[A-Ö]#',$svuosi)) {
            $this->virheet['svuosi'] = "Syntymävuoden tulee olla kokonaisluku";
        }
        
        else {       
            $this->svuosi = (int)$svuosi;
            unset($this->virheet['svuosi']);
        }
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
        $sql = "select hnro, nimi, kansalaisuus, seura, syntymavuosi, sukupuoli from nostaja";
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
        $sql = "select hnro, nimi, kansalaisuus, seura, sukupuoli, syntymavuosi from nostaja where sukupuoli = '".$sukupuoli."'";
        $tulos = nostaja::toteutaKysely($sql);
        if ($tulos==null){
            return null;
        }
        
        return nostaja::muodostaArray($tulos);
    
    }

    

    public static function haeNostajaNumerolla($hnro) {
        $sql = "select hnro, nimi, kansalaisuus,"
                . " seura, syntymavuosi,"
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
        $sql = "INSERT INTO nostaja(nimi, kansalaisuus, syntymavuosi, sukupuoli, seura) VALUES(?,?,?,?,?)"
                . " RETURNING hnro";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $tiedot = array($this->getNimi(),$this->getKansallisuus(),$this->getSvuosi(),$this->getSukupuoli(),$this->getSeura());
        
        $ok = $kysely->execute($tiedot);
        if ($ok) {
            $this->hnro = $kysely->FetchColumn();
        }
        return $ok;
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
                . " seura, syntymavuosi,"
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
        $sql = "UPDATE nostaja SET nimi = ?, kansalaisuus = ?, syntymavuosi = ?, seura = ?, sukupuoli = ?"
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
    
    public static function haeKaikkiNimet() {
        $sql = "SELECT nimi, hnro FROM nostaja";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        
  
        return $tulos;
    }
        
    public function haeKilpailut() {
        $sql = "SELECT * FROM kilpailu WHERE kilnro in"
                . " (select kilnro from kilpailu_nostaja where hnro = ".$this->getHnro().")";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function nostajanSijoitusKilpailussa($kilnro) {
        $sql = "select yt, tulokset.hnro as hnro, sukupuoli, nostaja.nimi as nimi"
                . " from (select te.tulos+ty.tulos as yt, te.hnro"
                . " from (select max(tulos) as tulos, hnro from nosto where"
                . " kilnro = ".$kilnro." and laji='tempaus' and "
                . "painoluokka='".$painoluokka."' group by hnro) as te inner join "
                . " (select max(tulos) as tulos, hnro from nosto where kilnro = ".$this->getKilnro(). " "
                . "and painoluokka='".$painoluokka."' and laji='tyonto'"
                . " group by hnro) as ty on (ty.hnro = te.hnro)) as tulokset inner join "
                . "nostaja on (tulokset.hnro = nostaja.hnro and sukupuoli='".$sarja."') order by yt desc ";
    }
    
}