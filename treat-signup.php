<?php session_start();

if (empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["genre"]) || empty($_POST["mail"]) || empty($_POST["pwd"])) {
    header('location:./signup.php?fail=yes' . "&target=" . $_GET['target']);
} else {

    include_once("params.inc.php");

    $id = mysqli_connect($host, $user, $password, $dbname);
    mysqli_set_charset($id, 'utf8');


#acces BD en PDO
    include_once("params.inc.php");


    try {
        // Data Source Name
        $dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
        // instanciation
        $pdo = new PDO($dsn, $user, $password);
        // ici on est connecté …
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    $req = "INSERT INTO `p1408263`.`projet-personne` (`id_personne`, `prenom`, `nom`, `genre`, `mail`, `mdp`) VALUES (NULL, '" . $_POST["prenom"] . "', '" . $_POST["nom"] . "', '" . $_POST["genre"] . "', '" . $_POST["mail"] . "', '" . $_POST["pwd"] . "')";
    $res = $pdo->query($req);


    if ($res != FALSE) {
        header('location:./login.php?fail=no' . "&target=" . $_GET['target']);
    } else {
        header('location:./signup.php?fail=yes' . "&target=" . $_GET['target']);
    }

}
?>
