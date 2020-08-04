<?php
session_start();
require_once 'dbConnexion.php';
require_once 'functions.php';
$object_Produit = new Produit;

/* triage
========================================================================== */
if (isset($_POST['selected_trie']) and !empty($_POST['selected_trie'])) {
    $_SESSION['triage'] = $object_Produit->sanitize_string($_POST['selected_trie']);
}
if (isset($_SESSION['triage']) and !empty($_SESSION['triage'])) {
    if ($_SESSION['triage'] == 1) {
        $_SESSION['selected_trie'] = "Prix";
    }
    if ($_SESSION['triage'] == 2) {
        $_SESSION['selected_trie'] = "Nouveautés";
    }
    if ($_SESSION['triage'] == 3) {
        $_SESSION['selected_trie'] = "Promotions";
    }
}

/* filtres type
========================================================================== */
if (isset($_POST['selected_type']) and !empty($_POST['selected_type'])) {
    $selectedValue = $object_Produit->sanitize_string($_POST['selected_type']);
    $selectedStatut = $object_Produit->sanitize_string($_POST['selected_type_statut']);
    if ($selectedStatut == "true") {
        array_push($_SESSION['filter_type'], $selectedValue);
    } elseif ($selectedStatut == "false") {
        if (($key = array_search($selectedValue, $_SESSION['filter_type'])) !== false) {
            unset($_SESSION['filter_type'][$key]);
        }
    }
}

/* filtres echelle
========================================================================== */
if (isset($_POST['selected_echelle_min']) and !empty($_POST['selected_echelle_min'])) {
    $selectedMin = $object_Produit->sanitize_string($_POST['selected_echelle_min']);
    $selectedMax = $object_Produit->sanitize_string($_POST['selected_echelle_max']);
    $selectedEchStatut = $object_Produit->sanitize_string($_POST['selected_echelle_statut']);

    if ($selectedEchStatut == "true") {
        $_SESSION['filter_echelle_min'] = $selectedMin;
        $_SESSION['filter_echelle_max'] = $selectedMax;
    }
}

/* marques
========================================================================== */
if (isset($_POST['selected_marque']) and !empty($_POST['selected_marque'])) {
    $selectedValue = $object_Produit->sanitize_string($_POST['selected_marque']);
    $selectedStatut = $object_Produit->sanitize_string($_POST['selected_marque_statut']);
    if ($selectedStatut == "true") {
        array_push($_SESSION['filter_marque'], $selectedValue);
    } elseif ($selectedStatut == "false") {
        if (($key = array_search($selectedValue, $_SESSION['filter_marque'])) !== false) {
            unset($_SESSION['filter_marque'][$key]);
        }
    }
}

/* couleurs
========================================================================== */
if (isset($_POST['selected_couleur']) and !empty($_POST['selected_couleur'])) {
    $selectedValue = $object_Produit->sanitize_string($_POST['selected_couleur']);
    $selectedStatut = $object_Produit->sanitize_string($_POST['selected_couleur_statut']);
    if ($selectedStatut == "true") {
        array_push($_SESSION['filter_couleur'], $selectedValue);
    } elseif ($selectedStatut == "false") {
        if (($key = array_search($selectedValue, $_SESSION['filter_couleur'])) !== false) {
            unset($_SESSION['filter_couleur'][$key]);
        }
    }
}

/* matériaux
========================================================================== */
if (isset($_POST['selected_matiere']) and !empty($_POST['selected_matiere'])) {
    $selectedValue = $object_Produit->sanitize_string($_POST['selected_matiere']);
    $selectedStatut = $object_Produit->sanitize_string($_POST['selected_matiere_statut']);
    if ($selectedStatut == "true") {
        array_push($_SESSION['filter_matiere'], $selectedValue);
    } elseif ($selectedStatut == "false") {
        if (($key = array_search($selectedValue, $_SESSION['filter_matiere'])) !== false) {
            unset($_SESSION['filter_matiere'][$key]);
        }
    }
}

$ppp = $object_Produit->product_per_page;
$nbr_items = $object_Produit->get_produit($bdd, 9999, 1);
$nbr = count($nbr_items);
$_SESSION['nbr_items'] = $nbr;
$page = $object_Produit->page($nbr, $ppp);
$get_produit = $object_Produit->get_produit($bdd, $ppp, $_SESSION['currentPage']);
// $object_Produit->url();
?>
<div class="vitrine">
    <?php $object_Produit->display_product($get_produit); ?>
</div>
<div id="triage">
    <form class="dropdown" id="form-trie" method="post">
        <div class="trie-btn">
            <p>Trier par :</p>
        </div>
        <div class="form-trie-content">
            <ul>
                <li>
                    <label for="triage1">Prix
                        <input type="radio" name="triage" value="1" id="triage1">
                    </label>
                </li>
                <li>
                    <label for="triage2">Nouveauté
                        <input type="radio" name="triage" value="2" id="triage2">
                    </label>
                </li>
                <li>
                    <label for="triage3">Promotions
                        <input type="radio" name="triage" value="3" id="triage3">
                    </label>
                </li>
            </ul>
        </div>
    </form>
    <div id="triage-info">
        <?php
                $object_Produit->echo_triage();
                $object_Produit->echo_nbrItem($bdd);
            ?>
        <p id="pages">Page <?php  echo $page ?></p>
    </div>

    <script>
        $(document).ready(function () {

            //envoyer le formulaire triage
            $("input[name=triage]").click(function () {
                var selected = $(this).attr('value');
                $("#trie-produits").load("php/vitrine.php", {
                    selected_trie: selected
                });
            });
        });
    </script>