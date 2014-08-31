<?php
require 'libs/tietokantayhteys.php';
require "libs/common.php";
require "models/nostaja.php";

$nostajanid = (int)$_POST['hnro'];
$muokattavanostaja = nostaja::haeNostajaNumerolla($nostajanid);

//naytaNakyma('testi', array('virhe'=>array('virhe3'=>$uudettiedot->getHnro())));
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



