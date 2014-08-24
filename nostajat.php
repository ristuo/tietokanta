<?php

require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';


$nostajat = nostaja::haeKaikkiNostajat();
$miehet = nostaja::haeSukupuolenPerusteella('mies');
$naiset = nostaja::haeSukupuolenPerusteella('nainen');
 

$hakunimi = $_POST["hakunimi"]; /*
$lisaa = $_POST['lisaa'];
if (!empty($lisaa)) {
    naytaNakyma('login.php');
}
 * 
 */
if (empty($hakunimi)) {
    naytaNakyma('nostajat', array('nostajat'=>  $nostajat, 'miehet' => $miehet, 'naiset'=>$naiset,'hakutehty'=>false));
}
else  {
    
    $haetut = nostaja::haeNostajatNimella($hakunimi);
    naytaNakyma('nostajat', array('haetut'=>$haetut, 'hakutehty'=>true));
}