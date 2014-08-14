<?php
require 'libs/common.php';

if (onkoKirjauduttu()) {
    naytaNakyma('paivita');
}
else {
    header('Location: login.php');
}