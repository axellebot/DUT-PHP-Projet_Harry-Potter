<?php
session_start();

include_once "./expiring_session.php";


if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
    HEADER("location:./home.php");
}



?>

<html>
<head>
    <?php
    include_once("./head.html");
    ?>
    <title>Se connecter</title>
</head>
<body>

<?php
$page_actuel = "login";
include "./header.php";
?>

<div class="structure">
    <div id="body">
        <aside id="right_column">
            <div id="rightbar_content">
                <a
                    <?php
                    if(isset($_GET['target'])){
                        echo " href='./signup.php?target=" . $_GET['target'] . "'.";
                    }else{
                        echo " href='./signup.php";
                    }
                    ?>
                    class="signup_button">
                    <p>S'INSCRIRE</p>
                </a>
            </div>
        </aside>

        <section>
            <article class="centre">
                <h1>Connectez-vous</h1>
            </article>

                <?php
                if(isset($_GET['target'])) {

                    echo "<marquee behavior='scroll' bgcolor='red' loop='-1' width='100%' scrollamount='10' style='color:#ffffff;  font-weight: bold; font-size: x-large;'>
                        Vous devez être connecté pour accéder à cette page
                        </marquee>";
                    echo"<article>";
                    echo "<form action='./treat-login.php?target=" . $_GET['target'] . "' method=POST>";
                }else{
                    echo "<article>";
                    echo "<form action='./treat-login.php' method=POST>";
                }
                ?>

                    <label>E-mail : </label><input type="email" name="mail" size="30" maxlength="40" value=""><br><br>
                    <label>Password : </label><input type="password" name="pwd" size="30" maxlength="40"
                                                     value=""><br><br>
                    <button type="reset">Effacer</button>
                    <button type="submit">Connexion</button>

                </form>

                <?php
                if (!empty($_GET['fail']) && $_GET['fail'] == "yes") {
                    echo "Vous vous êtes mal connecté";
                    echo "<script type='text/javascript'>alert('Erreur de connexion !');</script>";
                }
                if (!empty($_GET['fail']) && $_GET['fail'] == "no") {
                    echo "Vous vous êtes bien inscrit";
                }
                ?>
            </article>
        </section>
    </div>
</div>

<?php
include "./footer.php";
?>
</body>
</html>