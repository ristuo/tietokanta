<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'models/nostaja.php';
require 'models/nosto.php';


$id = (int)$_GET['hnro'];
$nostaja = nostaja::haeNostajaNumerolla($id);
$tempaukset = nosto::haeNostajanNostotLajissa($id, "tempaus");
$tyonnot = nosto::haeNostajanNostotLajissa($id, "tyonto");
$kilpailut = $nostaja->haeKilpailut();
$kisatulokset = array();
foreach ($kilpailut as $kilpailu) {
    $kisatulokset[$kilpailu->kilnro]=$nostaja->nostajanSijoitusKilpailussa($kilpailu->kilnro)->sija;
    
    if ($nostaja->nostajanSijoitusKilpailussa($kilpailu->kilnro)->sija==null) {
        naytaNakyma('etusivu');
    }
}

naytaNakyma('yksinostaja',array('nostaja'=>$nostaja, 'tempaukset'=>$tempaukset,
    'tyonnot'=>$tyonnot, 'kilpailut'=>$kilpailut, 'kisatulokset'=>$kisatulokset));
