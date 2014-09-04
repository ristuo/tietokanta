<?php
require 'libs/tietokantayhteys.php';
require "libs/common.php";
require "models/nostaja.php";
/**
 * Sivun avulla muokataan nostajan tietoja.
 */
$nostajanid = (int)$_POST['hnro'];
$muokattavanostaja = nostaja::haeNostajaNumerolla($nostajanid);

/**
 * Jos käyttäjä ei ole antanut mitään tietoja, näytetään oletussivu.
 */
if (empty($_POST['nimi'])) {
    naytaNakyma('muokkaaNostajaa', array('nimi'=>$muokattavanostaja->getNimi(),
            'hnro'=>$muokattavanostaja->getHnro(), 'sukupuoli'=>$muokattavanostaja->getSukupuoli(),
        'seura'=>$muokattavanostaja->getSeura(), 'kansallisuus'=>$muokattavanostaja->getKansallisuus(),
        'svuosi'=>$muokattavanostaja->getSvuosi()));
}

$uudettiedot = new nostaja();
$uudettiedot->setHnro($nostajanid);
$uudettiedot->setNimi($_POST['nimi']);
$uudettiedot->setSeura($_POST['seura']);
$uudettiedot->setSukupuoli($_POST['sukupuoli']);
$uudettiedot->setSvuosi($_POST['syntymavuosi']);
$uudettiedot->setKansallisuus($_POST['kansallisuus']);

/**
 * Mikäli annetut tiedot sisältävät virheellisiä arvoja, näytetään uudestaa muokkaussivu, jolle
 * laitetaan ne tiedot, jotka olivat kelvollisia.
 */
if ($uudettiedot->getVirheet()!=null) {
    naytaNakyma('muokkaaNostajaa', array('virhe'=> $uudettiedot->getVirheet(),
        'hnro'=>$nostajanid, 'sukupuoli'=>$uudettiedot->getSukupuoli(), 'seura'=>$uudettiedot->getSeura(),
        'kansallisuus'=>$uudettiedot->getKansallisuus(),'svuosi'=>$uudettiedot->getSvuosi(), 'nimi'=>$uudettiedot->getNimi())); 
}
else {
    $uudettiedot->muokkaa();
    $_SESSION['ilmoitus']="Lisääminen onnistui!";
    header('Location: nostajat.php');
    exit();
}



