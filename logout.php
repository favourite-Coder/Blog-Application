<?php

require 'config/constants.php';

//DESTORY ALL SESSION AND REDIRECT USER TO HOME PAGE

session_destroy();
header('location: ' . ROOT_URL);
die();