<?php
require 'tietokantayhteys.php';
$sql = "select * from nostaja";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();

function haeRivi() {
    return $kysely->fetch();
}