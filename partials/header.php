<?php
require 'config/database.php';
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog APP PHP & MYSQL</title>
    <!---CUSTOM CSS--->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!---ICONSCOUT CDN--->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!---GOOGLE FONTS (POPPINS)--->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL ?>" class="nav_logo">SENA*</a>
            <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <!--THE HEADER TO DISPLAY WHEN A USER IS AND ADMIN OR NOT---->
                <?php if(isset($_SESSION['user-id'])) : ?> 
                    <li class="nav_profile">
                    <div class="avatar">
                    <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>"> <!--FETCH AVATAR FROM DATABASE-->
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>Logout.php">Log Out</a></li>
                    </ul>
                </li>
                <?php else : ?> <!---SHOW THIS--->
             <li><a href="<?= ROOT_URL ?>signin.php">Sign In</a></li> 
            <?php endif ?>
            </ul>
            <!-----Small screen nav----->
            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-times"></i></button>
        </div>
    </nav>
    <!-------All--Nav Ends---------->
