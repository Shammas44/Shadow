<?php
require_once 'php/header.php';
require_once 'php/dbConnexion.php';
require_once 'php/functions.php';
$id = $_GET['id'];
$object_Produit = new Produit;
$get_produit_details = $object_Produit->get_produit_details($bdd, $id);
$get_5_produit = $object_Produit->get_5_produit($bdd);
if (!isset($_SESSION['shoppingBasket'])) {
    $_SESSION['shoppingBasket']=array();
}
if (isset($_POST['quantity']) and !empty($_POST['quantity'])) {
     $_SESSION['shoppingBasket'][$id] = $_POST['quantity'];
}
?>

<!--==================================-->
<!-- MAIN -->
<!--==================================-->
<main>
    <!--====  Produit display  ====-->
    <section id="section1">
        <!-- Produit - images -->
        <div id="produit_images">
            <div id="img_showcase" style="background-image: url('images/lampes_images/<?php echo $id;?>-1.jpg')">
            </div>
            <div id="get_image_details">
                <?php $object_Produit->get_image_details($bdd, $id);?>
            </div>
        </div>
        </div>

        <!-- Produit - info -->
        <div id="produit_content">
            <div id="produit_title">
                <h2><?php echo $get_produit_details['pro_nom']. ' / '. $get_produit_details['typ_nom']; ?></h2>
                <p id="marque"><?php echo $get_produit_details['mar_nom']; ?></p>
            </div>
            <div id="produit_info">
                <h3>Description</h3>
                <p><?php echo $get_produit_details['pro_description']; ?></p>
                <h3>Caractéristiques</h3>
                <ul>
                    <li>Couleur(s) : <?php $object_Produit->get_couleur_details($bdd, $id);?></li>
                    <li>Matière(s) : <?php $object_Produit->get_matiere_details($bdd, $id);?></li>
                    <li>Dimensions : <?php echo $get_produit_details['pro_dimension']; ?></li>
                    <li>Poids : <?php echo $get_produit_details['pro_poids']; ?></li>
                </ul>
            </div>

            <!-- Produit ajouter au panier -->
            <form id="produit_panier" method="post">
                <div id="prix">
                    <p><?php echo $get_produit_details['prixfinal']. ' CHF'; ?></p>
                    <p <?php $object_Produit->divClass2($get_produit_details);?>>
                        <?php echo 'au lieu de '.$get_produit_details['pro_prix']. ' CHF'; ?>
                    </p>
                </div>
                <div id="div_rabais" <?php $object_Produit->divClass2($get_produit_details);?>>
                    <p id="rabais"><?php echo $get_produit_details['pro_rabais']. '%'; ?></p>
                </div>
                <input type="text" value="<?= $id ?>" style="display:none" name="id">
                <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">
                <input type="submit" value="Ajouter au panier">
                <div class="div_dispo">
                    <div <?php $object_Produit->availableClass2($get_produit_details); ?>></div>
                    <p><?php $object_Produit->availableText2($get_produit_details); ?></p>
                </div>
            </form>
        </div>
    </section>

    <!--====  Produit similaire  ====-->
    <section id="section2">
        <h2>Vous aimerez aussi</h2>
        <!-- vitrine -->
        <div class="vitrine is-borderTop">
            <?php $object_Produit->display_product($get_5_produit); ?>
        </div>
    </section>
</main>
<?php
require_once 'php/footer.php';
?>