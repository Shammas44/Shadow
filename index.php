<?php
require_once 'php/header.php';
require_once 'php/dbConnexion.php';
require_once 'php/functions.php';
//Objet(s)
$object_Produit = new Produit;
//Propriété(s)
$ppp = $object_Produit->product_per_page;
//Session
if (!isset($_SESSION['filter_type'])) {
    $_SESSION['filter_type']=array();
}
if (!isset($_SESSION['filter_marque'])) {
    $_SESSION['filter_marque']=array();
}
if (!isset($_SESSION['filter_couleur'])) {
$_SESSION['filter_couleur']=array();
}
if (!isset($_SESSION['filter_matiere'])) {
$_SESSION['filter_matiere']=array();
}
if (isset($triageValue)) {
 $triage = $object_Produit->sanitize_string($triageValue);
 $_SESSION['triage'] = $triage;
}else {
    $triage = 1;
}
$object_Produit->currentPage();
$get_type = $object_Produit->get_type($bdd);
$get_echelle = $object_Produit->get_echelle($bdd);
$get_marque = $object_Produit->get_marque($bdd);
$get_couleur = $object_Produit->get_couleur($bdd);
$get_matiere = $object_Produit->get_matiere($bdd);
?>
<!--==================================-->
<!-- MAIN -->
<!--==================================-->
<main>
    <!-- Diapo -->
    <section class="sectionDiapo">
        <div class="diaporama">
            <input type="radio" class="points point1" name="coins" id="slide_1" checked>
            <input type="radio" class="points point2" name="coins" id="slide_2">
            <input type="radio" class="points point3" name="coins" id="slide_3">
            <input type="radio" class="points point4" name="coins" id="slide_4">

            <div class="boites">
                <div class="slides">
                    <div class="boite point1"><img class="imgDuDiapo imgDiapo1" src="images/diapo/diapo1.jpg"
                            alt="image du diapo1"></div>
                    <div class="boite point2"><img class="imgDuDiapo imgDiapo2" src="images/diapo/diapo1.jpg"
                            alt="image du diapo2"></div>
                    <div class="boite point3"><img class="imgDuDiapo imgDiapo3" src="images/diapo/diapo1.jpg"
                            alt="image du diapo3"></div>
                    <div class="boite point4"><img class="imgDuDiapo imgDiapo4" src="images/diapo/diapo1.jpg"
                            alt="images du diapo4"></div>
                </div>
            </div>

            <div class="labels">
                <label for="slide_1" class="s-index a-label"></label>
                <label for="slide_2" class="s-index b-label"></label>
                <label for="slide_3" class="s-index c-label"></label>
                <label for="slide_4" class="s-index d-label"></label>
            </div>
        </div>
    </section>

    <!--====  Shop  ====-->
    <section id="shop">
        <!-- Filtres -->
        <form method="post" id="filtres">
            <h2>Filtrer par</h2>
            <!-- Type de produit -->
            <div class="filtre_produit">
                <div class="filtre is-displayBlock">
                    <h3>Type de produits</h3>
                </div>
                <div class="filtre_liste">
                    <ul>
                        <?php
                        $inputName = "filtre-type";
                        $object_Produit->display_filter($get_type, $inputName);
                         ?>
                    </ul>
                </div>
            </div>

            <!-- Prix -->
            <div class="filtre_produit">
                <div class="filtre is-displayBlock">
                    <h3>Prix</h3>
                </div>
                <div class="filtre_liste">
                    <ul>
                        <?php 
                        $inputName = "filtre-echelle";
                        $object_Produit->display_filter($get_echelle, $inputName); 
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Marque -->
            <div class="filtre_produit">
                <div class="filtre is-displayBlock">
                    <h3>Marques</h3>
                </div>
                <div class="filtre_liste scrollbar" id="style-2">
                    <div class="force-overflow">
                        <ul>
                            <?php 
                            $inputName = "filtre-marque";
                            $object_Produit->display_filter($get_marque, $inputName); 
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Couleurs -->
            <div class="filtre_produit">
                <div class="filtre is-displayBlock">
                    <h3>Couleurs</h3>
                </div>
                <div class="filtre_liste">
                    <ul>
                        <?php 
                        $inputName = "filtre-couleur";
                        $object_Produit->display_filter($get_couleur, $inputName); 
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Matériaux -->
            <div class="filtre_produit">
                <div class="filtre filtre_last is-displayBlock">
                    <h3>Matériaux</h3>
                </div>
                <div class="filtre_liste">
                    <ul>
                        <?php 
                        $inputName = "filtre-matiere";
                        $object_Produit->display_filter($get_matiere, $inputName); 
                        ?>
                    </ul>
                </div>
            </div>
        </form>
        <!-- triage et vitrine -->
        <div id="trie-produits"></div>
    </section>
</main>
<?php
require_once 'php/footer.php';