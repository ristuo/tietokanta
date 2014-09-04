<?php
/**
 * Koska kyseessä on oma taulunsa sille on myös oma mallinsa. Nyt kuitenkin painoluokat
 * on määritelty lajin säännöissä eikä niitä ole mitään syytä muuttaa koskaan. Niinpä riittää
 * funktio, joka hakee painoluokat (tätä tarvitaan valikossa).
 * @return type
 */
function getPainoluokat() {
    $sql = "select * from painoluokat";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchAll(PDO::FETCH_OBJ);
    
}