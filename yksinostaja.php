<?php
require 'libs/common.php';
require 'models/nostaja.php';


$id = (int)$_GET['hnro'];
$nostot = haeNostajanNostotNumerolla($id);
$nostajantiedot = haeNostajaNumerolla($id);


naytaNakyma('yksinostaja',array('nostajantiedot'=>$nostajantiedot, 'nostot'=>$nostot));
