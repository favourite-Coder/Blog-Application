<?php
require 'config/database.php';

//GET SIGNUP FORM DATA WHEN SIGN UP BUTTON CLICKED

if(isset($_POST['submit'])) {
   $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
   $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $avatar = $_FILES['avatar'];

   //VALIDATE INPUTS
   if(!$firstname) {
    $_SESSION['signup'] = "Please enter your First Name";
   } elseif(!$lastname) {
    $_SESSION['signup'] = "Please enter your Last Name";
   } elseif(!$username) {
    $_SESSION['signup'] = "Please enter your Username";
   } elseif(!$email) {
    $_SESSION['signup'] = "Please enter a valid email address";
   } elseif(strlen($createpassword) < 8 || strlen($confirmpassword)
    < 8) {
    $_SESSION['signup'] = "Password should be 8+ characters";
   } elseif(!$avatar['name']) {
    $_SESSION['signup'] = "Please add an avatar";
   } else {
    //CHECK IF PASSWORDS DON'T MATCH
    if($createpassword !== $confirmpassword) {
        $_SESSION['signup'] = "Passwords do not match!";
    }else {
        // IF MATCHED THEN HASH PASSWORD
        $hashed_password = password_hash($createpassword,
        PASSWORD_DEFAULT);

        echo $createpassword . '<br/>';
        echo $hashed_password;
    }
   }

    //WHEN SIGNUP FORM BUTTON NOT CLICKED
}else {
   header('location: ' . ROOT_URL . 'signup.php');
   die();
}