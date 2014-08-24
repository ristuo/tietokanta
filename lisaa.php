<?php

require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';

if (!onkoKirjauduttu()){
    naytaNakyma('login');
    
}

if (empty($_POST['nimi']) && empty($_POST['seura']) && empty($_POST['kansallisuus']) && empty($_POST['syntymapaiva'])) {
    naytaNakyma('lisaa');
}

$lisattava = new nostaja();
$lisattava->setNimi($_POST['nimi']);
$lisattava->setSeura($_POST['seura']);
$lisattava->setKansallisuus($_POST['kansallisuus']);
$lisattava->setSukupuoli($_POST['sukupuoli']);
$lisattava->setSvuosi($_POST['syntymapaiva']);

/*
naytaNakyma('lisaa', array( 'virhe'=>$lisattava->getNimi().$lisattava->getSeura().$lisattava->getSvuosi().$lisattava->getSukupuoli().$lisattava->getKansallisuus()));
*/
if (!$lisattava->onkoKelvollinen()) {
    naytaNakyma('lisaa', array('virhe'=>$lisattava->getVirheet())); 
}
else {
    $lisattava->lisaaNostaja();
    header('Location: nostajat.php');
    exit();
}
$id = $lisattava->lisaaNostaja();