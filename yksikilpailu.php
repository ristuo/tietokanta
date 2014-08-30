<?php
require 'models/kilpailu.php';
require 'libs/common.php';
require 'libs/tietokantayhteys.php';

$id = (int)$_GET['kilnro'];
$kilpailuntiedot = kilpailu::haeKilpailuNumerolla($id);
if ($kilpailuntiedot->getKilnro()==null) {
    naytaNakyma('testi');
}
$kilpailuntiedot->haeTuloksetPainoluokassa('105 kg', 'nainen');
naytaNakyma('yksikilpailu', array('kilpailuntiedot'=>$kilpailuntiedot));