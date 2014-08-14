<?php
session_start();

function naytaNakyma($sivu, $data){
    require 'views/pohja.php';
    exit();
}

function sovelluksenJuuriosoite() {
    return 'mikäs se oli';
}

function onkoKirjauduttu() {
    if (isset($_SESSION['kayttaja'])) {
        return true;
    }    
    return false;
}

