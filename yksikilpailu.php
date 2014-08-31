<?php

require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'models/painoluokka.php';
require 'models/kilpailu.php';

$id = (int)$_GET['kilnro'];
$kilpailuntiedot = kilpailu::haeKilpailuNumerolla($id);
$tuloksetmiehet = array();
$tuloksetnaiset = array();
$painoluokat = getPainoluokat();


$i = 0;
foreach ($painoluokat as $painoluokka) {
    $tuloksetmiehet[$i] = $kilpailuntiedot->haeTuloksetPainoluokassa($painoluokka->painoluokka, 'mies');
    $i++;
}

$tuloksetmiehet[1]=$kilpailuntiedot->haeTuloksetPainoluokassa('94 kg', 'mies');

$i = 0;
foreach ($painoluokat as $painoluokka) {
    $tuloksetnaiset[$i] = $kilpailuntiedot->haeTuloksetPainoluokassa($painoluokka->painoluokka, 'naiset');
    $i++;
}


naytaNakyma('yksikilpailu', array('kilpailuntiedot'=>$kilpailuntiedot,'painoluokat'=>$painoluokat, 'tuloksetmiehet'=>$tuloksetmiehet, 'tuloksetnaiset'=>$tuloksetnaiset));