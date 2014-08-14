<?php
require "libs/common.php";
require "models/nostaja.php";
$nostajat = haeKaikkiNostajat();
$miehet = haeSukupuolenPerusteella('mies');
$naiset = haeSukupuolenPerusteella('nainen');
naytaNakyma('nostajat', array('nostajat'=>  $nostajat, 'miehet' => $miehet, 'naiset'=>$naiset));

