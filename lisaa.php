<?php

require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';

if (!onkoKirjauduttu()){
    naytaNakyma('login');
    
}

if (empty($_POST['nimi']) && empty($_POST['seura']) && empty($_POST['kansallisuus']) && empty($_POST['syntymavuosi'])) {
    naytaNakyma('lisaa');
    
}

$uudettiedot = new nostaja();
$uudettiedot->setNimi($_POST['nimi']);
$uudettiedot->setSeura($_POST['seura']);
$uudettiedot->setKansallisuus($_POST['kansallisuus']);
$uudettiedot->setSukupuoli($_POST['sukupuoli']);
$uudettiedot->setSvuosi($_POST['syntymavuosi']);

/*
naytaNakyma('lisaa', array( 'virhe'=>$lisattava->getNimi().$lisattava->getSeura().$lisattava->getSvuosi().$lisattava->getSukupuoli().$lisattava->getKansallisuus()));
*/
if ($uudettiedot->getVirheet()!=null) {
    naytaNakyma('lisaa', array('virhe'=> $uudettiedot->getVirheet(), 'seura'=>$uudettiedot->getSeura(),
        'kansallisuus'=>$uudettiedot->getKansallisuus(),'svuosi'=>$uudettiedot->getSvuosi(), 'nimi'=>$uudettiedot->getNimi())); 
}
else {
    $uudettiedot->lisaaNostaja();
    $_SESSION['ilmoitus']="Lisääminen onnistui!";
    header('Location: nostajat.php');
    exit();
}
