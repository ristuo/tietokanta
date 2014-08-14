<?php

require 'libs/tietokantayhteys.php';


class kayttaja {
    private $knro;
    private $sposti;
    private $salasana;
    
    public function __construct($knro, $sposti, $salasana) {
        $this->sposti = $sposti;
        $this->knro = $knro;
        $this->salasana = $salasana;
    }
    
    
    public static function haeKayttajaTunnuksilla($kayttaja, $passu) {
        
        
        
        $sql = 'SELECT knro, sposti, salasana FROM kayttaja WHERE sposti = ? AND salasana = ? LIMIT 1';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $passu));
        $tulos = $kysely->fetchObject();
        
        
        if ($tulos == null) {
            return null;
        }
        else {
            $id = $tulos->knro;
            $nimi = $tulos->sposti;
            $salasana = $tulos->salasana;
            $palautettava = new kayttaja($id, $nimi, $salasana);
            return $palautettava;
        }
    }
}