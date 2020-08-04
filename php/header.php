<?php
require_once 'dbConnexion.php';
require_once 'styles.php';
require_once 'functions.php';
$sb = new ShoppingBasket;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php //getCssFiles(); //récupère les fichier CSS?>
    <link rel="stylesheet" type="text/css" href="styles/css/main.css">
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
        <div class="header-div1">

            <!-- logo -->
            <h1>
                <a href="index.php" id="logo"><img src="images/logo_blanc.svg"></a>
                <p style="display: none;">Shadow Vente de luminaires</p>
            </h1>

            <!-- search field -->
            <div class="searchContainer">
                <form action="#">
                    <input type="text" placeholder="Produit, marque, catégories..." name="search">
                    <button type="submit">
                    </button>
                </form>
            </div>

            <!-- bouton panier -->
            <a class="btnPanier" href="shopBasket.php">
                <p class="btnPanier-prix"><?php echo $total = $sb->finalPrice($bdd); ?></p>
                <p class="nbrPanier <?php $sb->display_ShoppingBasket_nbr(); ?>">
                    <?php $sb->echo_ShoppingBasket_nbr(); ?></p>
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
        <div class="header-div2">
            <div class="avantage avantage1">

                <p>2 ans de garantie minimum</p>
            </div>

            <div class="avantage avantage2">

                <p>Envoi postal gratuit à partir de CHF 75.-</p>
            </div>

            <div class="avantage avantage3">

                <p>Droit de retour de 2 semaines</p>
            </div>
        </div>

        <!--====  header-div3  ====-->
        <div class="header-div3">

            <!-- Menu -->
            <div class="dropdown dropdown1">
                <div class="dropbtn">
                    <p>Catégories</p>
                </div>
                <!-- <div class="dropdown-content">
						<a href="https://sebastientraber.com/instantnet/desktop_actu.html">Desktop</a>
						<a href="https://sebastientraber.com/instantnet/desktop_actu1.html">Desktop article</a>
						<a href="https://sebastientraber.com/instantnet/mobile_actu.html">Mobile</a>
						<a href="https://sebastientraber.com/instantnet/mobile_actu1.html">Mobile article</a>
					</div> -->
            </div>

            <div class="monCompte">
                <a href="#">Mon compte</a>
            </div>

            <div class="dropdown dropdown2">
                <div class="dropbtn">
                    <p>Français</p>
                </div>
                <!-- <div class="dropdown-content">
						<a href="https://sebastientraber.com/instantnet/desktop_actu.html">Desktop</a>
						<a href="https://sebastientraber.com/instantnet/desktop_actu1.html">Desktop article</a>
						<a href="https://sebastientraber.com/instantnet/mobile_actu.html">Mobile</a>
						<a href="https://sebastientraber.com/instantnet/mobile_actu1.html">Mobile article</a>
					</div> -->
            </div>

            <div class="dropdown dropdown3">
                <div class="dropbtn">
                    <p>Les pages de la maquette</p>
                </div>
                <div class="dropdown-content dropdown-content3">
                    <a href="accueil.html" class="lien_page lien_page1">Accueil</a>
                    <a href="produit.html" class="lien_page lien_page2">Produit</a>
                    <a href="commande.html" class="lien_page lien_page3">Commande</a>
                    <a href="connexion.html" class="lien_page lien_page4">Connexion et inscription</a>
                    <a href="panier.html" class="lien_page lien_page5">Panier</a>
                </div>
            </div>
        </div>
    </header>