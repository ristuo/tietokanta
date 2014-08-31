<?php

function getPainoluokat() {
    $sql = "select * from painoluokat";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchAll(PDO::FETCH_OBJ);
    
}