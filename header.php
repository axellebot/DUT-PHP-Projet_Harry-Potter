<div id="menu" class="fixed">
    <div class="structure black">
        <a href="./home.php" class="logo"></a>
        <nav>

            <?php

            include_once "./expiring_session.php";
            if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
                switch ($page_actuel) {
                    case "home":
                        echo "<a href='./home.php' class=active" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;

                    case "newbid":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;

                    case "profil":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php' class=active" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;

                    case "bidlist":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php' class=active" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;

                    case "login":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;

                    case "signup":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;


                    default:
                        echo "<a href='./home.php' class=active" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./profil.php'" . ">PROFIL</a>";
                        echo "<a href='./logout.php'" . "> SE DECONNECTER </a>";
                        break;
                }

                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    echo "<a href='./admin.php' style='color:red'>ADMIN</a>";
                }

            } else {
                switch ($page_actuel) {
                    case "home":
                        echo "<a href='./home.php' class=active" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;

                    case "newbid":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;

                    case "profil":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;

                    case "bidlist":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php' class=active" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;

                    case "login":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php' class=active" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;

                    case "signup":
                        echo "<a href='./home.php'" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php' class=active" . "> S'INSCRIRE </a>";
                        break;


                    default:
                        echo "<a href='./home.php' class=active" . ">ACCUEIL</a>";
                        echo "<a href='./bidlist.php'" . ">ANNONCES</a>";
                        echo "<a href='./.php'" . "></a>";
                        echo "<a href='./login.php'" . ">SE CONNECTER</a>";
                        echo "<a href='./signup.php'" . "> S'INSCRIRE </a>";
                        break;
                }
            }
            ?>
        </nav>

    </div>
</div>
