<?php
require 'models/kilpailu.php';
require 'libs/common.php';
require 'libs/tietokantayhteys.php';

$id = (int)$_GET['kilnro'];
$kilpailuntiedot = kilpailu::haeKilpailuNumerolla($id);
naytaNakyma('yksikilpailu', array('kilpailuntiedot'=>$kilpailuntiedot));