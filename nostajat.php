<?php

require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';


$nostajat = nostaja::haeKaikkiNostajat();
$miehet = nostaja::haeSukupuolenPerusteella('mies');
$naiset = nostaja::haeSukupuolenPerusteella('nainen');


naytaNakyma('nostajat', array('nostajat'=>  $nostajat, 'miehet' => $miehet, 'naiset'=>$naiset));

