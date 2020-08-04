<?php
class Produit
{
    public $product_per_page = 12;

/* Requêtes sql
========================================================================== */

    //Requête sql: produits
    public function get_produit($bdd, $ppp, $currentPage) {
        //valeur par défaut: $price
        $price = 'prixfinal, pro_rabais DESC';
        $new = 'pro_date DESC, prixfinal ,pro_rabais DESC';
        $sale = 'pro_rabais DESC, prixfinal';

        if (isset($_SESSION['triage'])) { 
            if ($_SESSION['triage'] == '1') {
                $order = $price;    
            } elseif ($_SESSION['triage'] == '2') { 
                $order = $new;
            } elseif ($_SESSION['triage'] == '3') { 
                $order = $sale;
            }
            } else {
                $order = $price;
            }

        $x = ($currentPage - 1) * $ppp; //start
        $y = $ppp; //produit par page

        if (isset($_SESSION['filter_type']) and !empty($_SESSION['filter_type'])) {
            $filterType = "AND idx_type IN (" . implode(", ", $_SESSION['filter_type']) . ")";
        } else {
            $filterType = "";
        }

        if (isset($_SESSION['filter_marque']) and !empty($_SESSION['filter_marque'])) {
            $filterMarque = "AND idx_marque IN (" . implode(", ", $_SESSION['filter_marque']) . ")";
        } else {
            $filterMarque = "";
        }

        if (isset($_SESSION['filter_couleur']) and !empty($_SESSION['filter_couleur'])) {
            $filterCouleur = "AND idx_couleur IN (" . implode(", ", $_SESSION['filter_couleur']) . ")";
        } else {
            $filterCouleur = "";
        }

        if (isset($_SESSION['filter_matiere']) and !empty($_SESSION['filter_matiere'])) {
            $filterMatiere = "AND idx_matiere IN (" . implode(", ", $_SESSION['filter_matiere']) . ")";
        } else {
            $filterMatiere = "";
        }

        if (isset($_SESSION['filter_echelle_min']) and !empty($_SESSION['filter_echelle_min'])) {
            $filterEchelle = "AND ROUND(pro_prix -((pro_prix * pro_rabais) /100 ),2) BETWEEN " .
                $_SESSION['filter_echelle_min'] . " and " . $_SESSION['filter_echelle_max'] . "";
        } else {
            $filterEchelle = "";
        }

        $sql = "SELECT DISTINCT(id_produit), pro_nom, ROUND(pro_prix -((pro_prix * pro_rabais) /100 ),2) AS prixfinal, mar_nom, pro_rabais, pro_quantite, pro_date
        FROM marques, produits, couleurs, produits_couleurs pc, matieres, produits_matieres pm
        WHERE id_marque = idx_marque $filterType $filterEchelle $filterMarque $filterCouleur $filterMatiere
        AND id_produit = pc.idx_produit
        AND id_couleur = idx_couleur
        AND id_produit = pm.idx_produit
        AND id_matiere = idx_matiere
        ORDER BY $order
        LIMIT :x, :y";

        $sth = $bdd->prepare($sql);
        $sth->bindParam(':x', $x, PDO::PARAM_INT);
        $sth->bindParam(':y', $y, PDO::PARAM_INT);
        $sth->execute();
        //$sth->debugDumpParams();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: produits détails
    public function get_produit_details($bdd, $id) {
        if (is_array($id)) {
            $ids = implode(", ", $id);
        }else {
            $ids = $id;
        }
        $sql = 'SELECT id_produit, pro_nom, ROUND(pro_prix -((pro_prix * pro_rabais) /100 ),2) AS prixfinal, pro_prix, pro_poids, pro_dimension, mar_nom, pro_rabais, pro_quantite,  pro_date, pro_description, typ_nom
        FROM marques, types, produits
        WHERE id_marque = idx_marque
        AND id_type = idx_type
        AND id_produit In('.$ids.')';
        $sth = $bdd->prepare($sql);
        $sth->execute();
        if (is_array($id)) {
            $data = $sth->fetchAll();
        }else {
            $data = $sth->fetch();
        }
        return $data;
    }

    //Requête sql: produits détails -> couleurs
    public function get_couleur_details($bdd, $id) {
        $sth = $bdd->prepare('SELECT cou_nom
        FROM produits, produits_couleurs pc, couleurs
        WHERE id_produit = pc.idx_produit AND pc.idx_couleur = id_couleur
        AND id_produit = :id');
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll();

        $nbrArray = count($data);
        $del = "";
        for ($i = 0; $i < $nbrArray; $i++) {
            echo $del . $data[$i]['cou_nom'];
            $del = ", ";
        }
    }

    //Requête sql: produits détails -> matières
    public function get_matiere_details($bdd, $id) {
        $sth = $bdd->prepare('SELECT mat_nom
        FROM produits, produits_matieres pm, matieres
        WHERE id_produit = pm.idx_produit AND pm.idx_matiere = id_matiere
        AND id_produit = :id');
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll();

        $nbrArray = count($data);
        $del = "";
        for ($i = 0; $i < $nbrArray; $i++) {
            echo $del . $data[$i]['mat_nom'];
            $del = ", ";
        }
    }

    //Requête sql: produits détails -> images
    public function get_image_details($bdd, $id) {
        $sth = $bdd->prepare('SELECT COUNT(idx_produit) AS nbr_images
        FROM produits, images
        WHERE id_produit = idx_produit
        AND id_produit = :id');
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch();
        extract($data);

        if ($nbr_images > 1) {
            for ($i = 1; $i <= $nbr_images; $i++) {
                $out = <<<_END
                <input type="radio" name="radio" class="points point1 is-displayNone" id="radio_$i">
                <label for="radio_$i" class="radio_label radio_label$i">
                <div style="background-image: url('images/lampes_images/$id-$i.jpg')">
                <div class="div_transparent"></div></div>
                </label>
                _END;
                echo $out;
            }
        }
    }

    //Requête sql: nbr de produit
    public function get_nbr_produit($bdd) {
        $sth = $bdd->prepare('SELECT COUNT(id_produit) AS produitNbr
        FROM produits');
        $sth->execute();
        $data = $sth->fetch();
        return $data;
    }

    //Requête sql: produits limité à 5 produits
    public function get_5_produit($bdd) {
        $sth = $bdd->prepare('SELECT id_produit, pro_nom, ROUND(pro_prix -((pro_prix * pro_rabais) /100 ),2) AS prixfinal, mar_nom, pro_rabais, pro_quantite, pro_date
        FROM marques, produits
        WHERE id_marque = idx_marque
        LIMIT :lim1 , :lim2');
        $sth->bindValue(':lim1', 0, PDO::PARAM_INT);
        $sth->bindValue(':lim2', 5, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: matières
    public function get_matiere($bdd) {
        $sth = $bdd->prepare('SELECT m.mat_nom, COUNT(p.idx_produit) AS cnt, idx_matiere
        FROM  matieres m, produits_matieres p
        WHERE m.id_matiere = p.idx_matiere
        GROUP BY p.idx_matiere
        ORDER BY m.mat_nom');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: couleurs
    public function get_couleur($bdd) {
        $sth = $bdd->prepare('SELECT c.cou_nom, COUNT(p.idx_produit) AS cnt, idx_couleur
        FROM  couleurs c, produits_couleurs p
        WHERE c.id_couleur = p.idx_couleur
        GROUP BY p.idx_couleur
        ORDER BY c.cou_nom');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: marques
    public function get_marque($bdd) {
        $sth = $bdd->prepare('SELECT m.mar_nom, COUNT(p.idx_marque) AS cnt, idx_marque
        FROM  marques m, produits p
        WHERE m.id_marque = p.idx_marque
        GROUP BY p.idx_marque
        ORDER BY m.mar_nom');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: type de produit
    public function get_type($bdd) {
        $sth = $bdd->prepare('SELECT t.typ_nom, COUNT(p.idx_type) AS cnt, idx_type
        FROM  types t, produits p
        WHERE t.id_type = p.idx_type
        GROUP BY p.idx_type
        ORDER BY t.typ_nom');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    //Requête sql: échelle de prix
    public function get_echelle($bdd) {
        $sth = $bdd->prepare('SELECT ech_nom, COUNT(id_produit) AS cnt, id_echelle_prix, ech_min,ech_max FROM
        (SELECT p.id_produit
        ,e.id_echelle_prix, e.ech_min,ech_max, ech_nom
        FROM produits p, echelle_prix e
        WHERE ROUND(p.pro_prix -((p.pro_prix * p.pro_rabais) /100 ),2)  BETWEEN e.ech_min AND e.ech_max) t
        group by id_echelle_prix');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

/* Méthodes d'affichage
========================================================================== */

    //Afficher/cacher les rabais
    public function divClass($row) {
        $pro_rabais = $row['pro_rabais'];
        $classRabais = "class='rabais'";
        if ($pro_rabais == 0) {
            $classRabais = "class='is-displayNone'";
        }
        return $classRabais;
    }

    //Afficher/cacher les rabais (page produit)
    public function divClass2($get_produit_details) {
        $classRabais = "";
        if ($get_produit_details['pro_rabais'] == 0) {
            $classRabais = "class='is-displayNone'";
            echo $classRabais;
        }
    }

    //Changer la couleur de la pastille de disponibilité des produits
    public function availableClass($row) {
        $classAvailable = "class='is-green dispo_pastille'";
        if ($row['pro_quantite'] < 5) {
            $classAvailable = "class='is-yellow dispo_pastille'";
        }
        if ($row['pro_quantite'] == 0) {
            $classAvailable = "class='is-red dispo_pastille'";
        }
        return $classAvailable;
    }

    //Changer la couleur de la pastille de disponibilité des produits (page produit)
    public function availableClass2($dataDetailsProduit) {
        $classAvailable = "class='is-green dispo_pastille'";
        if ($dataDetailsProduit['pro_quantite'] < 5) {
            $classAvailable = "class='is-yellow dispo_pastille'";
        }
        if ($dataDetailsProduit['pro_quantite'] == 0) {
            $classAvailable = "class='is-red dispo_pastille'";
        }
        echo $classAvailable;
    }

    //Changer le text de disponibilité
    public function availableText($row) {
        $textAvailable = "En stock";
        if ($row['pro_quantite'] < 5) {
            $textAvailable = "Stock faible";
        }
        if ($row['pro_quantite'] == 0) {
            $textAvailable = "Rupture de stock";
        }
        return $textAvailable;
    }

    //Changer le text de disponibilité (page produit)
    public function availableText2($dataDetailsProduit) {
        $textAvailable = "En stock";
        if ($dataDetailsProduit['pro_quantite'] < 5) {
            $textAvailable = "Stock faible";
        }
        if ($dataDetailsProduit['pro_quantite'] == 0) {
            $textAvailable = "Rupture de stock";
        }
        echo $textAvailable;
    }

    //Afficher/masquer l'étiquette "nouveau"
    public function isNew($row) {
        $classDate = "class='nouveau'";
        $db_date = $row['pro_date'];
        $todayMinus30 = date('Y-m-d', strtotime('-30 day'));
        if ($db_date < $todayMinus30) {
            $classDate = "class='is-displayNone'";
        }
        return $classDate;
    }

    //Afficher les produits sur plusieurs pages
    public function page($nbr_items, $ppp) {
        if (!empty($_SESSION['nbr_items'])) {
            $produit_nbr = $_SESSION['nbr_items'];
        } else {
            $produit_nbr = $nbr_items[0];
        }
        $total_pages = ceil($produit_nbr / $ppp);

        if ($_SESSION['nbr_items'] < $ppp and $_SESSION['currentPage'] !== 1) {
            $_GET['page'] = 1;
            $_SESSION['currentPage'] = 1;
        }

        $new = $_SESSION['currentPage'] + 1;
        $new2 = $total_pages - 1;
        $array=array();

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $_SESSION['currentPage']) {
                $class = "class='is-colorYellow'";
            } else {
                $class = "";
            }
            $output = "<a $class href='index.php?page=$i'>$i</a> ";
            array_push($array, $output);
        }
        $string = implode($array);
        if ($_SESSION['currentPage'] < $total_pages and $_SESSION['currentPage'] !== $total_pages) {
            $output2 = " <a href='index.php?page=$new'>Suivant</a>";
        }
        if ($_SESSION['currentPage'] == $total_pages and $_SESSION['currentPage'] > 1) {
            $output2 = " <a href='index.php?page=$new2'>Précédant</a>";
        }
        $newOutput = $string.$output2;
        return $newOutput;
    }

    //Recupère le N° de page actuel
    public function currentPage() {
        if (isset($_GET['page'])) {
            $_SESSION['currentPage'] = $this->sanitize_string($_GET['page']);
        } else {
            $_SESSION['currentPage'] = 1;
        }
    }

    //Aseptiser les entrées
    public function sanitize_string($var) {
        $var = strip_tags($var);
        $var = htmlentities($var, ENT_QUOTES);
        $var = trim($var, " \ $!+-_");
        $var = stripslashes($var);
        return $var;
    }

    //Affiche le nom du triage utilisé
    public function echo_triage() {
         if (isset($_SESSION['selected_trie'])) {
            echo "<p id='triageValue'>" . $_SESSION['selected_trie'] . "</p>";
        } else {
            echo "<p id='triageValue'>" . "Prix" . "</p>";
        }
    }

    //Affiche le nombre de produit trouvé
    public function echo_nbrItem($bdd) {
        if (isset($_SESSION['nbr_items'])) {
            echo "<p id='nbrProduit'>".$_SESSION['nbr_items'] . " produit(s) en tout</p>";
        } else {
            $nbr = $this->get_nbr_produit($bdd);
            echo "<p id='nbrProduit'>". $nbr[0] . " produit(s) en tout</p>";
        }
    }

    //affiche les produits
    public function display_product($get_produit) {
        foreach ($get_produit as $row) {
            $id = $row['id_produit'];
            $output = "
            <article class='produit'>
                <a href='produit.php?id=" . $row['id_produit'] . "'>
                    <div class='div_imgProduit'>
                        <img src='images/lampes_images/" . $row['id_produit'] . "-1.jpg' alt='image du produit' class='img_produit'>
                        <div " . $this->divClass($row) . ">
                            <p>" . $row['pro_rabais'] . "% </p>
                        </div>
                        <div " . $this->isNew($row) . ">
                            <p>Nouveau</p>
                        </div>
                    </div>
                    <div class='produit_info'>
                        <p class='produit_nom'>" . $row['pro_nom'] . "</p>
                        <p class='produit_marque'>" . $row['mar_nom'] . "</p>
                        <div class='div_dispo'>
                            <div " . $this->availableClass($row) . "></div>
                            <p> " . $this->availableText($row) . "</p>
                        </div>
                        <p class='produit_prix'>" . $row['prixfinal'] . "CHF</p>
                    </div>
                </a>
            </article>
            ";
            echo $output;
        }
    }

    //affiche les filtrer produits
    public function display_filter($filterType, $inputName) {
        $i = 0;
        $type = "checkbox";
        foreach ($filterType as $row) {
            $id = "value='" . $row[2] . "'";
            $idValue = $row[2];
            $check = "";
            if ($inputName == "filtre-type") {
                if (in_array($idValue, $_SESSION['filter_type'])) {
                    $check = " data-check='true'";
                } else {
                    $check = "";
                }
            }
            if ($inputName == "filtre-marque") {
                if (in_array($idValue, $_SESSION['filter_marque'])) {
                    $check = " data-check='true'";
                } else {
                    $check = "";
                }
            }
             if ($inputName == "filtre-couleur") {
                if (in_array($idValue, $_SESSION['filter_couleur'])) {
                    $check = " data-check='true'";
                } else {
                    $check = "";
                }
            }
             if ($inputName == "filtre-matiere") {
                if (in_array($idValue, $_SESSION['filter_matiere'])) {
                    $check = " data-check='true'";
                } else {
                    $check = "";
                }
            }
            if ($inputName == "filtre-echelle") {
                $id = "data-min='" . $filterType[$i]['ech_min'] . "'" . " data-max='" . $filterType[$i]['ech_max'] . "'";
                $type = "radio";
                $min = $filterType[$i]['ech_min'];
                $max = $filterType[$i]['ech_max'];
                    if (isset($_SESSION['filter_echelle_min']) and isset($_SESSION['filter_echelle_max'])) {
                        if ($min == $_SESSION['filter_echelle_min'] and $max == $_SESSION['filter_echelle_max']) {
                            $check = " data-check='true'";
                        }
                    } else {
                    $check = "";
                    }
            }
            $output = "
            <li>
                <label class='container'>
                    <input type='" . $type . "' name='" . $inputName . "'" . $id . $check . " >
                    <span class='checkmark'></span>
                    <p>" . $row[0] . "
                        <span>(" . $row['cnt'] . ")</span>
                    </p>
                </label>
            </li>";
            echo $output;
            $i++;
        }
    }

    public function url() {
        // $string = 'index.php?properties&status=av&page=1';
        $string = $_SERVER['REQUEST_URI'];
        $parts = parse_url($string);
        $queryParams = array();
        parse_str($parts['query'], $queryParams);
        unset($queryParams['page']);
        $queryString = http_build_query($queryParams);
        $url = $parts['path'] . '?' . $queryString;
    }
}

class ShoppingBasket
{
    //echo le nbr de produit dans le panier
    public function echo_ShoppingBasket_nbr() {
        $_SESSION['shoppingBasket_nbr'] = array_sum($_SESSION['shoppingBasket']);
        if ($_SESSION['shoppingBasket_nbr'] > 99) {
            echo "99+";
        }else {
            echo $_SESSION['shoppingBasket_nbr'];
        }
    }

    //cache le nbr de produit dans le panier quand le panier est vide
    public function display_ShoppingBasket_nbr() {
        $_SESSION['shoppingBasket_nbr'] = array_sum($_SESSION['shoppingBasket']);
        if ($_SESSION['shoppingBasket_nbr'] <= 0) {
            echo "is-displayNone";
        }
    }

    //echo le prix final du panier
    public function finalPrice($bdd) {
        if (isset($_SESSION['shoppingBasket']) and !empty($_SESSION['shoppingBasket'])) {
            $idList = "WHERE id_produit IN (" . implode(", ", array_keys($_SESSION['shoppingBasket'])) . ")";
        } else {
            $idList = "";
        }
        $array=array();
        if (isset($_SESSION['shoppingBasket']) and !empty($_SESSION['shoppingBasket'])) {
            foreach ($_SESSION['shoppingBasket'] as $key => $value) {
                $var = "when id_produit = ".$key." then ROUND(pro_prix -((pro_prix * pro_rabais) /100),2)*".$value;
                array_push($array, $var);
            }
             $nbr = "CASE ".implode(" ", $array)." END AS total";
        }
        $sql = "SELECT pro_rabais, pro_prix, id_produit,$nbr
        FROM produits $idList";
        $sth = $bdd->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
        $sum = 0;
        foreach ($data as $item) {
            $sum += $item['total'];
        }
        $total = $sum." CHF";
        return $total;
    }

    //afficher les articles dans le panier
    public function display_ShoppingBasket($data) {
        if (isset($_SESSION['shoppingBasket']) and !empty($_SESSION['shoppingBasket'])) {
            foreach ($data as $item) {
                $id = $item['id_produit'];
                $output = "<article>
                    <img src='images/lampes_images/".$item['id_produit']."-1.jpg' alt='image du produit'>
                    <div class='sb_info'>
                        <p class='sb_nom'>".$item['pro_nom']."<br><span class='sb_marque'>".$item['mar_nom']."</span>
                        </p>
                        <p class='sb_description'>".$item['pro_description']."</p>
                        <p class='sb_livraison'>livraison en 1-2 jours ouvrables</p>
                    </div>
                    <div class='sb_prix'>
                        <p>".$item['prixfinal']." CHF</p>
                        <div><input type='number' id='quantity' name='quantity' min='1' max='100' 
                        value='".$_SESSION['shoppingBasket'][$id]."'></div>
                        <p>".$_SESSION['shoppingBasket'][$id]*$item['prixfinal']." CHF</p>
                    </div>
                </article>";
                echo $output;
            }
        }
    }
}