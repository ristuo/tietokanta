<?php


class kilpailu {
    
    private $kilnro;
    private $nimi;
    private $paivamaara;
    private $taso;
    private $paikka;
    
    public function __construct() {
        $this->kilnro = null;
        $this->nimi = null;
        $this->paivamaara = null;
        $this->taso = null;
        $this->paikka = null;
    }
    
    public function getKilnro(){ return $this->kilnro; }
    public function getNimi(){ return $this->nimi; }
    public function getPaivamaara(){ return $this->paivamaara; }
    public function getTaso(){ return $this->taso; }
    public function getPaikka(){ return $this->paikka; }
    public function setKilnro($kilnro){$this->kilnro = $kilnro;}
    public function setNimi($nimi){$this->nimi = $nimi;}
    public function setPaivamaara($paivamaara){$this->paivamaara = $paivamaara;}
    public function setTaso($taso){$this->taso = $taso;}
    public function setPaikka($paikka){$this->paikka = $paikka;}

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
    
    public function haeTuloksetPainoluokassa($painoluokka, $sarja) {

        $sql = "select yt, tulokset.hnro as hnro, sukupuoli, nostaja.nimi as nimi from (select te.tulos+ty.tulos as yt, te.hnro from (select max(tulos) as tulos, hnro from nosto where"
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












