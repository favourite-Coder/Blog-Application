<?php
require '../partials/header.php';


//CHECK LOGIN STATUS 
if(!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
?>


