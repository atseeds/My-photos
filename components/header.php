<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Document</title>


</head>

<body>
    <?php
    $user = (isset($_SESSION["user"])) ? $_SESSION["user"] : "Duc";
    ?>
    <header>
        <div class="header-top">
            <div class="head-top__title">
                <h2>MY IMAGES</h2>
            </div>
            <div class="search-box">
                <input class="search-box__input" type="text" placeholder="Search">
                <button class="search-box__btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="logo">
                <img src="img/logo.svg" alt="logo" style="width: 60px;">
            </div>
        </div>
    </header>
    <!-- <div class="nav"> -->
    <div class="nav">
        <ul class="nav__links">
            <?php
            if (isset($user['email'])) { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">My Photos</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="sign_out.php">Sign Out</a></li>
            <li>
                <h3 class="username">
                    <?php echo "Welcom, " . $user['email'] ?>
                </h3>
            </li>
            <?php } else { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="sign_in.php">Sign In</a></li>
            <li><a href="sign_up.php">Sign Up</a></li>
            <!-- <li><a href="">Dashboard</a></li> -->
            <?php } ?>
        </ul>
    </div>
    <!-- </div> -->