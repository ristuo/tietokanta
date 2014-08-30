<?php
require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';

$nostajanid = (int)$_POST['hnro'];
$uudettiedot = new nostaja();
$muokattavanostaja = nostaja::haeNostajaNumerolla($nostajanid);

//naytaNakyma('testi', array('virhe'=>array('virhe3'=>$uudettiedot->getHnro())));
if (empty($_POST['nimi'])) {
    naytaNakyma('muokkaaNostajaa', array('nostaja'=>$muokattavanostaja));
}


$uudettiedot->setHnro($nostajanid);
$uudettiedot->setNimi($_POST['nimi']);
$uudettiedot->setSeura($_POST['seura']);
$uudettiedot->setSukupuoli($_POST['sukupuoli']);
$uudettiedot->setSvuosi($_POST['syntymavuosi']);
$uudettiedot->setKansallisuus($_POST['kansallisuus']);
$uudettiedot->muokkaa();

$_SESSION['ilmoitus']="Muokkaus onnistui!";
header("LOCATION: nostajat.php");