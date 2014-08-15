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
    public function getKilpailu(){ return $this->kilpailu; }
    public function getNimi(){ return $this->nimi; }
    public function getPaivamaara(){ return $this->paivamaara; }
    public function getTaso(){ return $this->taso; }
    public function getPaikka(){ return $this->paikka; }
    public function setKilpailu($kilpailu){$this->kilpailu = $kilpailu;}
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
            $lisattava->setNimi($rivi->nimi);
            $lisattava->setTaso($rivi->taso);
            $lisattava->setPaikka($rivi->paikka);
            $lisattava->setPaivamaara($rivi->paivamaara);
            
            $palautettava[$i]=$lisattava;
            $i++;
        }
        return $palautettava;
    }
    
    
}












