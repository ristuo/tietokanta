<?php
/**
 * Sivun tarkoitus on mahdollistaa kilpailujen tietojan lisääminen tietokantaan.
 */
require "libs/common.php";
require "models/nostaja.php";
require "models/kilpailu.php";
require 'libs/tietokantayhteys.php';

if (!onkoKirjauduttu()){
    naytaNakyma('login');
    
}

if (empty($_POST['nimi']) && empty($_POST['paikka']) && empty($_POST['taso']) && empty($_POST['paivamaara'])) {
    naytaNakyma('lisaaKilpailu');
}

$nimi = $_POST['nimi'];
$paikka = $_POST['paikka'];
$paivamaara=$_POST['paivamaara'];
$taso=$_POST['taso'];

$lisattava = new kilpailu(); 
$lisattava->setNimi($nimi);
$lisattava->setPaikka($paikka);
$lisattava->setTaso($taso);
$lisattava->setPaivamaara($paivamaara);

if ($lisattava->getVirheet()==null) {
    $lisattava->lisaaKantaan();
    $_SESSION['ilmoitus']="Lisääminen onnistui!";
    header('Location: kilpailut.php');
}

else {
    naytaNakyma('lisaaKilpailu', array('virhe'=>$lisattava->getVirheet(),'nimi'=>$lisattava->getNimi(),
        'paikka'=>$lisattava->getPaikka(),'taso'=>$lisattava->getTaso()));
}


exit();

