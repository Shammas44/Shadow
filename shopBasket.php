<?php
require_once 'php/header2.php';
require_once 'php/dbConnexion.php';
require_once 'php/functions.php';
$object_Produit = new Produit;
$sb = new ShoppingBasket;
?>
<main>
    <h2 class="section-H2">Mon panier</h2>
    <div id="shopBasket_items">
        <!-- shopBasket catégories -->
        <div id="shopBasket_cat">
            <p>Article(s)</p>
            <p>Prix</p>
            <p>Nombre</p>
            <p>Prix total</p>
        </div>
        <form action="">
            <?php 
            $id = array_keys($_SESSION['shoppingBasket']);
            $data = $object_Produit->get_produit_details($bdd, $id);
            $sb->display_ShoppingBasket($data) 
            ?>
        </form>
    </div>
    <div id="prix_et_prommo">
        <!-- code prommo -->
        <div id="promo_code">
            <p>Code de prommotion</p>
            <form action="">
                <input type="text" placeholder="Mon code...">
            </form>
        </div>
        <!-- prixfinal -->
        <div id="div_prixfinal">
            <p>sous-total</p>
            <p><?= $total = $sb->finalPrice($bdd); ?></p>
            <div class="stroke1"></div>
            <p>inclus 7.7% TVA</p>
            <p><?= ($total*7.7)/100 ?></p>
            <div class="stroke2"></div>
            <p>Total</p>
            <p><?= $total ?></p>
            <form action="">
                <input type="submit" value="Valider la commande">
            </form>
        </div>
    </div>
</main>
<?php
require_once 'php/footer.php';