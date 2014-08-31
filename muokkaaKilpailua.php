<?php

require 'libs/tietokantayhteys.php';
require "libs/common.php";
require "models/kilpailu.php";

if (!onkoKirjauduttu()) {
    naytaNakyma('login');
}

$kilnro = $_POST['kilnro'];
$kilpailu = kilpailu::haeKilpailuNumerolla($kilnro);

if (empty($_POST['nimi'])) {
    naytaNakyma('muokkaaKilpailua', array('kilpailu'=>$kilpailu));

    
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
$uudettiedot->muokkaa();


$_SESSION['ilmoitus']="Muokkaus onnistui!";
header("LOCATION: nostajat.php");


