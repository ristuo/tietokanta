<?php

class kayttaja {
    private $id;
    private $tunnus;
    private $salasana;
    
    public function __construct($id, $tunnus, $salasana) {
        $this->tunnus = $tunnus;
        $this->id = $id;
        $this->salasana = $salasana;
    }
}