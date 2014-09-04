<?php
/**
 * Luokan avulla käsitellään kilpailuihin liittyviä tietoja.
 */

class kilpailu {
    
    private $kilnro;
    private $nimi;
    private $paivamaara;
    private $taso;
    private $paikka;
    private $virheet;
    
    public function __construct() {
        $this->kilnro = null;
        $this->nimi = null;
        $this->paivamaara = null;
        $this->taso = null;
        $this->paikka = null;
        $this->virheet=array();
    }
    
    public function getKilnro(){ return $this->kilnro; }
    public function getNimi(){ return $this->nimi; }
    public function getPaivamaara(){ return $this->paivamaara; }
    public function getTaso(){ return $this->taso; }
    public function getPaikka(){ return $this->paikka; }
    public function setKilnro($kilnro){$this->kilnro = $kilnro;}
    
    public function setNimi($nimi){
        
        if (trim($nimi)=='') {
            $this->virheet['nimi']="Nimi ei voi olla tyhjä!";
        }
        else if (preg_match('#[0-9]#',$nimi)) {
            $this->virheet['nimi']="Nimessä ei voi olla numeroita";
        }
        
        else if (strlen($nimi)>100) {
            $this->virheet['nimi']="Nimi ei voi olla yli 100 merkkiä pitkä";
        }
        
        else {
            $this->nimi = $nimi;
            unset($this->virheet['nimi']);
        }
        
        
        
        
        
    }
    
    /**
     * Aseta päivämäärä. Metodin avulla voi asettaa päivämäärän kilpailulle. 
     * Päivämäärän tulee olla SQL:n standardimuodossa, mikä tarkistetaan ennen
     * arvon tallentamista oliolle.
     * @param date $paivamaara
     */
    public function setPaivamaara($paivamaara){
        
        $ok = true;
        $syote = explode("-",$paivamaara);
        if (!preg_match('#[1000-2013]#',$syote[0])) {
            $ok=false;
        }
        else if (!preg_match('#[1-12]#',$syote[1])) {
            $ok=false;
        }
        else if (!preg_match('#[1-31]#',$syote[2])) {
            $ok=false;
        }
        if ($ok) {
            $this->paivamaara = $paivamaara;
            unset($this->virheet['paivamaara']);
        }
        else {
            $this->virheet['paivamaara']="Anna päivämäärä oikeassa formaatissa!";
        }
        
    }
    public function setTaso($taso){
        
        
        $this->taso = $taso;
        
    }
    
    
    /**
     * Aseta paikka. Paikannimessä ei saa olla yli 50 merkkiä eikä se saa sisältää numeroita. 
     * @param String $paikka
     */
    public function setPaikka($paikka){
        
        if (strlen($paikka) > 50) {
            $this->virheet['paikka']="Paikannimi ei voi olla yli 50 merkkiä pitkä";
        }
        
        else if (preg_match('#[0-9]#',$paikka)) {
            $this->virheet['paikka']="Paikannimessä ei voi olla numeroita";
            
        }        
        else {
            $this->paikka = $paikka;
            unset($this->virheet['paikka']);
        }
        
        
        
        
    }

    public function getVirheet() {
        return $this->virheet;
    }
    
    /**
     * Hae kaikki kilpailut. Metodi hakee kannasta kaikki kilpailut ja palauttaa kilpailuolioiden listan.
     * @return \kilpailu|null
     */
    public static function haeKaikkiKilpailut() {
        $sql = "SELECT * FROM kilpailu ORDER BY paivamaara DESC";
        $tulos = toteutaKysely($sql);
        if ($tulos == null) {
            return null;
        }
        
        $palautettava = array();
        $i = 1;
        
        foreach($tulos as $rivi) {
            $lisattava = new kilpailu();
            $lisattava->setKilnro($rivi->kilnro);
            $lisattava->setNimi($rivi->nimi);
            $lisattava->setTaso($rivi->taso);
            $lisattava->setPaikka($rivi->paikka);
            $lisattava->setPaivamaara($rivi->paivamaara);
            
            $palautettava[$i]=$lisattava;
            $i++;
        }
        return $palautettava;
    }
    
    /**
     * Metodi hakee kannasta tietyn kilpailun sen numeron perusteella.
     * @param int $kilnro
     * @return \kilpailu|null
     */
    public static function haeKilpailuNumerolla($kilnro) {
        $sql = 'SELECT * FROM kilpailu WHERE kilnro ='.$kilnro.' LIMIT 1';
        //$tulos = toteutaYksittaisKysely($sql);
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchObject();
         
        if ($tulos==null) {
            return null;
        }
         
        
        $palautettava = new kilpailu();
        $palautettava->setNimi($tulos->nimi);
        $palautettava->setPaikka($tulos->paikka);
        $palautettava->setTaso($tulos->taso);
        $palautettava->setPaivamaara($tulos->paivamaara);
        $palautettava->setKilnro($tulos->kilnro);
        return $palautettava;

    }
 
    public function lisaaKantaan() {
        $sql = "INSERT INTO kilpailu(nimi,paivamaara,taso,paikka) VALUES(?,?,?,?) RETURNING kilnro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(),$this->getPaivamaara(),$this->getTaso(),$this->getPaikka()));
        if ($ok) {
            $this->hnro = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    /**
     * Hae kaikki nimet. Metodi hakee kaikkien kilpailujen nimen ja numeron. On vaikea
     * kuvitella, mihin tätä voisi tarvita.
     * @return type
     */
    public static function haeKaikkiNimet() {
        $sql = "SELECT kilnro, nimi FROM kilpailu";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function poista() {
        $sql = "DELETE FROM kilpailu WHERE kilnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getKilnro()));
    }
    
    
    /**
     * Hae tulokset painoluokassa. Metodi hakee tietyssä painoluokassa
     * tässä kilpailussa kilpailleet henkilöt ja näiden kahden parhaan noston
     * yhteistuloksen, jonka mukaan myös tulosrelaatio on järjestetty. Mutta 
     * senhän tietysti näkee jo suoraan kyselystä.
     * @param String $painoluokka
     * @param String $sarja siis sukupuoli
     * @return type
     */
    public function haeTuloksetPainoluokassa($painoluokka, $sarja) {

        $sql = "select yt, tulokset.hnro as hnro, sukupuoli,"
                . " nostaja.nimi as nimi from (select te.tulos+ty.tulos "
                . "as yt, te.hnro from (select max(tulos) as tulos,"
                . " hnro from nosto where"
                . " kilnro = ".$this->getKilnro()." and laji='tempaus' and "
                . "painoluokka='".$painoluokka."' group by hnro) as te inner join "
                . " (select max(tulos) as tulos, hnro from nosto where kilnro = ".$this->getKilnro(). " "
                . "and painoluokka='".$painoluokka."' and laji='tyonto'"
                . " group by hnro) as ty on (ty.hnro = te.hnro)) as tulokset inner join "
                . "nostaja on (tulokset.hnro = nostaja.hnro and sukupuoli='".$sarja."') order by yt desc ";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        return $tulos;        
    }
        
        
    public function muokkaa() {
        $sql = "UPDATE kilpailu SET nimi=?, paikka=?, paivamaara=?, taso=? where kilnro = ".$this->getKilnro();
        $kysely = getTietokantayhteys()->prepare($sql);
        return $kysely->execute(array($this->getNimi(),$this->getPaikka(),$this->getPaivamaara(),$this->getTaso()));
        
        
        
    }
        
    
    
    
}












