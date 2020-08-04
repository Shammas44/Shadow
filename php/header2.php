<?php
require_once 'styles.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php getCssFiles(); //récupère les fichier CSS?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery-1.10.2.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <meta charset="UTF-8">
    <title>Shadow - vente de luminaire</title>
</head>

<body>
    <!--==================================-->
    <!-- HEADER -->
    <!--==================================-->
    <header>

        <!--====  header-div1  ====-->
        <div class="header2-div1">

            <!-- logo -->
            <h1>
                <a href="index.php" id="logo"><img src="images/logo_blanc.svg"></a>
                <p style="display: none;">Shadow Vente de luminaires</p>
            </h1>

            <!-- link retour -->
            <a class="btnRetour" href="index.php">
                <p>Continuer mes achats</p>
            </a>

            <!-- utilisateur -->
            <div class="utilisateur">
                <p>Serge Dupond</p>
                <form>
                    <input type="submit" name="logout" value="déconnexion" formmethod="post">
                </form>
                <?php
                if (isset($_POST['logout']) and $_POST['logout'] == "déconnexion") {
                    unset($_POST['logout']);
                    session_unset();

                }?>
            </div>
        </div>

        <!--====  header-div2 - avantages  ====-->
        <div class="header-div2 is-header2">
            <div class="avantage avantage1">
                <p class="is-colorWhite">2 ans de garantie minimum</p>
            </div>

            <div class="avantage avantage2">
                <p class="is-colorWhite">Envoi postal gratuit à partir de CHF 75.-</p>
            </div>

            <div class="avantage avantage3">
                <p class="is-colorWhite">Droit de retour de 2 semaines</p>
            </div>
        </div>
        </div>
    </header>