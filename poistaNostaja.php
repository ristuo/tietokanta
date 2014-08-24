<?php

require "libs/common.php";
require "models/nostaja.php";
require 'libs/tietokantayhteys.php';

$hnro = $_POST['hnro'];
$poistettava = new nostaja();
$poistettava->setHnro($hnro);
$poistettava->poista();


header("LOCATION: nostajat.php");

