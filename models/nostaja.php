<?php
require 'libs/tietokantayhteys.php';


function haeKaikkiNostajat() {
    $sql = "select nimi, kansalaisuus, seura, extract(year from syntymapaiva) as syntymavuosi from nostaja";
    return toteutaKysely($sql);
}

function toteutaKysely($haku) {
    $kysely = getTietokantayhteys()->prepare($haku);
    $kysely->execute();
    return $kysely->fetchAll(PDO::FETCH_OBJ);
}

function haeSukupuolenPerusteella($sukupuoli) {
    $sql = "select hnro, nimi, kansalaisuus, seura, extract(year from syntymapaiva) as syntymavuosi from nostaja where sukupuoli = '".$sukupuoli."'";
    return toteutaKysely($sql);
    
}

function haeNostajaNumerolla($hnro) {
    $sql = "select hnro, nimi, kansalaisuus, seura, extract(year from syntymapaiva) as syntymavuosi, sukupuoli from nostaja where hnro = ".$hnro;
    return toteutaKysely($sql);
    
}

function haeNostajanNostotNumerolla($hnro) {
    $sql = "select * from nosto where hnro = ".$hnro;
    return toteutaKysely($sql);
}