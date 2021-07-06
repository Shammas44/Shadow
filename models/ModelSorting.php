<?php
declare (strict_types = 1);
namespace models;

/**
 * class ModelSorting
 * @property $_modelProduct - un objet de type ModelProduct
 * @property $_sorting - tableau contenant les données de triage traîtées
 * @property $_sortingNbr - un nombre identifiant le triage (1, 2, 3)
 */
class ModelSorting
{
    private static $_modelProduct;
    private $_sorting;
    private $_sortingNbr;

    public function __construct()
    {
        self::$_modelProduct = new \models\ModelProduct;
        $sortingData = $this->getSortingData();
        $this->setSorting($sortingData);
    }
    /**
     * getSortingData - récupère les données de trie dans la superGlobal de Session
     * @return object $obj
     */
    private function getSortingData()
    {
        $sortingData = '';
        if (isset($_POST['sorting']) || isset($_SESSION['sorting']) && !empty($_SESSION['sorting'])) {

            $obj = '';
            if (isset($_POST['sorting'])) {
                $obj = $_POST['sorting'];
            }
            if (!isset($_SESSION['sorting'])) {
                $_SESSION['sorting'] = $obj;
            } elseif (!isset($_POST['sorting']) && isset($_SESSION['sorting'])) {
                $obj = $_SESSION['sorting'];
            } elseif ($obj != $_SESSION['sorting']) {
                $_SESSION['sorting'] = $obj;
            }

            $obj = json_decode($_SESSION['sorting']);
            $this->_sortingNbr = $obj->sorting;
            unset($obj->sorting);
            return $obj;
        }
    }
    /**
     * createSorting - définis la propriété $_sorting
     * @param  mixed $obj - les données brut à traiter
     * @return void
     */
    private function setSorting($obj)
    {
        $sorting = '';
        $sortingName = '';
        $filter = array();
        $filterNames = array('type' => 'filter_type', 'marque' => 'filter_brand', 'couleur' => 'filter_color', 'matiere' => 'filter_material');

        foreach ($filterNames as $key => $name) {
            $string = explode('_', $name);
            $newName = $string[0] . ucfirst($string[1]);
            $obj = $obj == null ? '' : $obj;

            if (property_exists($obj, $name) and !empty($obj->{$name})) {
                $$newName = "AND idx_" . $key . " IN (" . implode(", ", $obj->{$name}) . ")";
            } else {
                $$newName = '';
            }
            $filter[$newName] = $$newName;
        }

        if (property_exists($obj, 'filter_price') and !empty($obj->filter_price)) {
            $filterPrice = "AND ROUND(pro_prix -((pro_prix * pro_rabais) /100 ),2) BETWEEN " .
            $obj->filter_price[0] . " and " . $obj->filter_price[1] . "";
        } else {
            $filterPrice = '';
        }
        $filter['filterPrice'] = $filterPrice;

        if (property_exists($obj, 'searchQuery') and !empty($obj->searchQuery)) {
            $searchQuery = "AND pro_nom IN(SELECT pro_nom FROM produits ";
            $val = $obj->searchQuery;
            for ($i = 0; $i < count($val); $i++) {
                if ($i == 0) {
                    $searchQuery .= <<<EOT
                WHERE LOWER(p.pro_nom) REGEXP '^{$val[$i]}|{$val[$i]}$| {$val[$i]} '
                EOT;
                } else {
                    $searchQuery .= <<<EOT
                AND LOWER(p.pro_nom) REGEXP '^{$val[$i]}|{$val[$i]}$| {$val[$i]} '
                EOT;
                }
            }
            $searchQuery .= ')';
        } else {
            $searchQuery = '';
        }
        $filter['searchQuery'] = $searchQuery;

        $string = '';
        foreach ($filter as $key => $item) {
            $string .= $item;
        }
        $pattern = "/^AND/";
        $string = preg_replace($pattern, "WHERE", $string);

        switch ($this->_sortingNbr) {
            case 1:
                $sorting = 'price, discount DESC';
                $sortingName = 'Prix';
                break;
            case 2:
                $sorting = 'date DESC, price, discount DESC';
                $sortingName = 'Nouveautés';
                break;
            case 3:
                $sorting = 'discount DESC, price';
                $sortingName = 'Promotions';
                break;
            default:
                $sorting = 'Erreur';
        }

        if ($sorting != 'Erreur') {
            $sortingData = array(
                "sorting" => $sorting,
                "sortingName" => $sortingName,
                "whereClause" => $string,
                "modelProduct" => self::$_modelProduct,
            );
            $this->_sorting = $sortingData;
        }
    }

    public function getSorting()
    {
        return $this->_sorting;
    }
}
