<?php

require 'libs/tietokantayhteys.php';
require "libs/common.php";
require "models/kilpailu.php";

/**
 * Sivulla muokataan kilpailujen tietoja. Mikäli käyttäjä ei ole kirjautunut, näytetään kirjatumissivu.
 */

if (!onkoKirjauduttu()) {
    naytaNakyma('login');
}

$kilnro = $_POST['kilnro'];
$kilpailu = kilpailu::haeKilpailuNumerolla($kilnro);

/**
 * Mikäli mitään tietoja ei ole annettu, näytetään oletussivu.
 */
if (empty($_POST['taso']) ) {
    naytaNakyma('muokkaaKilpailua', array('nimi'=>$kilpailu->getNimi(), 'paikka'=>$kilpailu->getPaikka(),
        'taso'=>$kilpailu->getTaso(),'kilnro'=>$kilpailu->getKilnro(), 'paivamaara'=>$kilpailu->getPaivamaara()));

    
}

$pvm = $_POST['paivamaara'];
$nimi = $_POST['nimi'];
$taso = $_POST['taso'];
$paikka = $_POST['paikka'];

$uudettiedot = new kilpailu();
$uudettiedot->setPaikka($paikka);
$uudettiedot->setPaivamaara($pvm);
$uudettiedot->setTaso($taso);
$uudettiedot->setNimi($nimi);
$uudettiedot->setKilnro($kilnro);

/**
 * Jos annetuissa tiedoissa ei ole ongelmia, tehdään päivitys kantaan.
 */
if ($uudettiedot->getVirheet()==null) {
    $uudettiedot->muokkaa();
    $_SESSION['ilmoitus']="Muokkaus onnistui!";
    header("LOCATION: kilpailut.php");
    
}
else {
    naytaNakyma('muokkaaKilpailua', array('virhe'=>$uudettiedot->getVirheet(), 'nimi'=>$uudettiedot->getNimi(),
        'paikka'=>$uudettiedot->getPaikka(), 'paivamaara'=>$uudettiedot->getPaivamaara(), 'taso'=>$uudettiedot->getTaso()));
}



