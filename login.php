<?php
require 'libs/common.php';
require 'models/kayttaja.php';


if (empty($_POST["email"]) && empty($_POST["password"])) {
    naytaNakyma('login' /*,array('virhe' => 'Et antanut käyttäjätunnusta etkä salasanaa!')*/);

    
}

if (empty($_POST["email"]) && !empty($_POST["password"])) {
    naytaNakyma('login', array('virhe'=>array('virhe' => 'Et antanut käyttäjätunnusta!')));
}

$sposti = $_POST["email"];

if (empty($_POST['password'])) {
    naytaNakyma('login', array('virhe'=>array('virhe' => 'Et antanut salasanaa!'),'kayttaja' => $sposti));
    
    
}

$passu = $_POST["password"];


$kayttaja = kayttaja::haeKayttajaTunnuksilla($sposti, $passu);

if (!($kayttaja==null)) {
    $_SESSION['kayttaja']= $sposti;
    naytaNakyma('etusivu');
}

else {
    naytaNakyma('login',  array(
        'kayttaja'=>$sposti,
        'virhe' => "Kirjautuminen epäonnistui!",));
}

