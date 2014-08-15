<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'models/nostaja.php';
require 'models/nosto.php';


$id = (int)$_GET['hnro'];
$nostaja = nostaja::haeNostajaNumerolla($id);
$tempaukset = nosto::haeNostajanNostotLajissa($id, "tempaus");
$tyonnot = nosto::haeNostajanNostotLajissa($id, "tyonto");

naytaNakyma('yksinostaja',array('nostaja'=>$nostaja, 'tempaukset'=>$tempaukset, 'tyonnot'=>$tyonnot));
