<?php

switch ($target) {
    case "home":
        HEADER('location:./home.php');
        break;

    case "login":
        HEADER('location:./login.php');
        break;

    case "signup":
        HEADER('location:./signup.php');
        break;

    case "newbid":
        HEADER('location:./newbid.php');
        break;

    case "bidlist":
        HEADER('location:./bidlist.php');
        break;

    case "profil":
        HEADER('location:./profil.php');
        break;

    case "bid":
        HEADER('location:./bidlist.php');
        break;

    default:
        HEADER('location:./index.php');
        break;
}
?>