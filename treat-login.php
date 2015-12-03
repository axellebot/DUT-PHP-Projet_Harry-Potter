<?php

session_start();


if (isset($_GET['target'])) {
    $target = $_GET["target"];
} else{
    $target="";
}
echo $target;


#vérification du forms
if ($_POST["mail"] == NULL || $_POST["pwd"] == NULL) {
    header('location:./login.php?fail=yes' . "&target=" . $_GET['target']);
} else {
    $mail = $_POST["mail"];
    $mdp = $_POST["pwd"];
}


#acces BD en PDO
include_once("params.inc.php");

try {
    // Data Source Name
    $dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
    // instanciation
    $conn = new PDO($dsn, $user, $password);
    // ici on est connecté …
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}


$sql = "SELECT * FROM `p1408263`.`projet-personne` where `mail`='$mail' and `mdp`='$mdp';";

$res = $conn->query($sql)->fetchAll();
var_dump($res);
if ($res != FALSE) {
    echo"REQUEST SUCCED";
    foreach ($res as $row) {
        echo "res as row";
        var_dump($row);
        echo "<br>";
        var_dump($_SESSION);
        if ($row['mail'] == $mail && $row['mdp'] == $mdp) {
            echo "mail and mdp correspond";
            $_SESSION["login"] = $mail;
            $_SESSION["pwd"] = $mdp;

            if ($row['admin'] == 1) {
                $_SESSION["admin"] = 1;
            }

            $_SESSION['id']=$row['id_personne'];

            include "./target.php";

        } else {
            fail();
        }
    }

} else {
    fail();
}

function fail(){
    echo "REQUEST FAILED";
    if(isset($_GET['target'])){
        header('location:./login.php?fail=yes' . "&target=" . $_GET['target']);
    }else{
        header('location:./login.php?fail=yes');
    }
}

?>

<body>
<html>