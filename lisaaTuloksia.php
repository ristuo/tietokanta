<?php

require "libs/common.php";
require "models/nostaja.php";
require "models/kilpailu.php";
require "models/kilpailu_nostaja.php";
require "models/nosto.php";

if (!onkoKirjauduttu()) {
    naytaNakyma('login');
}

if (empty($_POST['1tempaus']) && empty($_POST['2tempaus']) && empty($_POST['3tempaus']) && empty($_POST['kilnro'])
        && empty($_POST['hnro']) && empty($_POST['painoluokka']) && empty($_POST['1tyonto']) && empty($_POST['2tyonto'])
        && empty($_POST['3tyonto'])) {
    naytaNakyma('lisaaTuloksia');
        }
        
$virhe = array();    
$tempausTulokset=array();
$tyontoTulokset=array();
$kelvollisetTempausTulokset = array();
$kelvollisetTyontoTulokset = array();

$tempausTulokset[1] = $_POST['1tempaus'];
$tempausTulokset[2] = $_POST['2tempaus'];
$tempausTulokset[3] = $_POST['3tempaus'];
$tyontoTulokset[1] = $_POST['1tyonto'];
$tyontoTulokset[2] = $_POST['2tyonto'];
$tyontoTulokset[3] = $_POST['3tyonto'];
$hnro = $_POST['hnro'];
$kilnro = $_POST['kilnro'];
$painoluokka = $_POST['painoluokka'];

for ($i = 1; $i <=3; $i++) {
    if ($tempausTulokset[$i]!=null && !is_numeric($tempausTulokset[$i])) {
        $virhe[$i]="Anna numeerinen arvo tempauksen ".$i." tulokseksi tai jätä kohta tyhjäksi";
    }
else { $kelvollisetTempausTulokset[$i]=$tempausTulokset[$i]; };
}

for ($i = 1; $i <=3; $i++) {
    if ($tyontoTulokset[$i]!=null && !is_numeric($tyontoTulokset[$i])) {
        $virhe[$i+3]="Anna numeerinen arvo työnnön ".$i." tulokseksi tai jätä kohta tyhjäksi";
    }
else { $kelvollisetTyontoTulokset[$i]=$tyontoTulokset[$i]; };
}

if (empty($virhe)) {
    
    $kn = new kilpailu_nostaja();
    $kn->setHnro($hnro);
    $kn->setKilnro($kilnro);
    $kn->lisaaKantaan();
    
    for ($i = 1; $i <=3;$i++) {
        $nosto = new nosto();
        $nosto->setLaji('tempaus');
        $nosto->setPainoluokka($painoluokka);
        $nosto->setJarjestysnumero($i);
        $nosto->setKilnro($kilnro);
        $nosto->setTulos($tempausTulokset[$i]);
        $nosto->setHnro($hnro);
        $nosto->lisaaKantaan();
    } 
    
    for ($i = 1; $i <=3;$i++) {
        $nosto = new nosto();
        $nosto->setLaji('tyonto');
        $nosto->setPainoluokka($painoluokka);
        $nosto->setJarjestysnumero($i);
        $nosto->setKilnro($kilnro);
        $nosto->setTulos($tyontoTulokset[$i]);
        $nosto->setHnro($hnro);
        $nosto->lisaaKantaan();
    }    
    
    
    naytaNakyma('lisaaTuloksia', array('onnistuminen'=>"Kilpailijan tulos lisättiin tietokantaan"));
}
else {
    naytaNakyma('lisaaTuloksia', array('virhe'=>$virhe, 'tempaukset'=>$kelvollisetTempausTulokset, 'tyonnot'=>$kelvollisetTyontoTulokset));    
}

