<?php
session_start();
require 'config/database.php';

if(isset($_POST['submit'])) {
    //GET THE FORM DATA
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$username_email){
     //IF EMPTY
     $_SESSION['signin'] = "Username or Email Required!";
    } elseif(!$password) {
        $_SESSION['signin'] = "Password Required!"; 
    } else {
        //FETCH USER FROM DATABASE
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        //IF INPUT MATCH WITH DATABASE
        if(mysqli_num_rows($fetch_user_result) == 1){

             //CONVERT RECORD INTO ASSOCIATIVE ARRAY
             $user_record = mysqli_fetch_assoc($fetch_user_result);
             $db_password = $user_record['password']; //get hashed password
             
             // COMPARE FORM PASSWORD WITH DATABASE PASSWORD
             if(password_verify($password, $db_password)){
                //SET SESSION FOR ACCESS CONTROL
                $_SESSION['user-id'] = $user_record['id'];
                //SET SESSION IF USER IS AN ADMIN
                if($user_record['is_admin'] == 1)  {
                    $_SESSION['user_is_admin'] = true;
                }

                //log user in
                header('location: ' . ROOT_URL . 'admin/');
             }else {
                //IF PASSWORD DO NOT MATCH
                $_SESSION['signin'] = "Please check your input"; 
            }

        }else {
            //IF USER NOT FOUND IN THE DATABASE
            $_SESSION['signin'] = "Oops! User not found"; 
        }
    }

    //IF ERROR OCCURRED IN ANY PROCESS
    if(isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}

?>