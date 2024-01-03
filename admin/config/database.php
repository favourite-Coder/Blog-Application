<?php
require 'constants.php';

//CONNECT TO THE DATABASE

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//CHECK IF THERE  IS ERROR

if(mysqli_errno($connection)) {
    die(mysqli_error($connection));
}