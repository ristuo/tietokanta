<?php
require "libs/tietokantayhteys1.php";
require "models/kilpailu.php";
require "libs/common.php";

$kilpailut = kilpailu::haeKaikkiKilpailut();

naytaNakyma('kilpailut', array('kilpailut'=>$kilpailut));