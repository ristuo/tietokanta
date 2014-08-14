<?php
require 'libs/common.php';

unset($_SESSION['kayttaja']);
header('Location: login.php');