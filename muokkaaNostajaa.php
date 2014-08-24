<?php
require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';

$nostajanid = (int)$_POST['hnro'];
$uudettiedot = new nostaja();

//naytaNakyma('testi', array('virhe'=>array('virhe3'=>$uudettiedot->getHnro())));

if (empty($_POST['nimi'])) {
    naytaNakyma('muokkaaNostajaa', array('nostajanid'=>$nostajanid));
}


$uudettiedot->setHnro($nostajanid);
$uudettiedot->setNimi($_POST['nimi']);
$uudettiedot->setSeura($_POST['seura']);
$uudettiedot->setSukupuoli($_POST['sukupuoli']);
$uudettiedot->setSvuosi($_POST['syntymapaiva']);
$uudettiedot->setKansallisuus($_POST['kansallisuus']);
$uudettiedot->muokkaa();
/*
$uudettiedot->setNimi('manuaalinenmuutos');
$uudettiedot->setSeura('joku seura');
$uudettiedot->setKansallisuus('joku');
$uudettiedot->setSukupuoli('mies');
$uudettiedot->setSvuosi('1989-05-05');
$uudettiedot->muokkaa();
 * */
 
//naytaNakyma('testi', array('virhe'=>array('virhe'=>$uudettiedot->getNimi(), 'virhe2'=>$uudettiedot->getSeura(), 'virhe3'=>$uudettiedot->getHnro())));

header("LOCATION: nostajat.php");