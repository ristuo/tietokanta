<?php
require 'libs/tietokantayhteys.php';
require "libs/common.php";
require "models/kilpailu.php";


$kilnro = $_POST['kilnro'];
$poistettava = new kilpailu();
$poistettava->setKilnro($kilnro);
$poistettava->poista();


header("LOCATION: kilpailut.php");
