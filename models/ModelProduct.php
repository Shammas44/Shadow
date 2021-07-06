<?php
declare (strict_types = 1);
namespace models;

class ModelProduct extends ModelCommon
{
    private $_productsPerPage = 12;
    /**
     * getProduct - récupère les produits souhaité dans la db
     * @param string $sorting - le nom des colonnes 'ORDER'
     * @param mixed $filter - les filtres
     * @param mixed $limit - le nombre de produit max à retourner
     * @return array $var - un tableau de produits (obj)
     */
    public function getProduct($sorting = 'price, discount DESC', $filter = '', $limit = null): array
    {
        $obj = '\models\Product';
        ($limit != null) ? $limit = $limit : $limit = $this->_productsPerPage;
        $page = $this->getUrlParam('page');
        $page = (is_numeric($page)) ? $page * $this->_productsPerPage - $this->_productsPerPage : 0;
        $var = [];
        $req = $this->getBdd()->prepare('SELECT DISTINCT id_produit AS id, pro_nom AS "name", pro_quantite AS quantity,
        mar_nom AS brand, pro_rabais AS discount, pro_date AS "date",
        ROUND(p.pro_prix -((p.pro_prix * p.pro_rabais) /100 ),2) AS price
        from produits AS p
        inner join marques AS m
        On p.idx_marque = m.id_marque
        inner join  produits_couleurs AS pc
        On p.id_produit = pc.idx_produit
        inner join produits_matieres AS pm
        ON p.id_produit = pm.idx_produit
        ' . $filter . '
        ORDER BY ' . $sorting . ' LIMIT ' . $page . ', ' . $limit);
        $productNbr = $this->countProduct($req);
        $req->execute();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $var['products'][] = new $obj($data);
        }
        $var['productNbr'] = $productNbr;
        return $var;
    }
    /**
     * countProduct
     * @param  string $query - une requête SQL
     * @return int $productNbr - le nombre de produit retourné par la requête SQL
     */
    public function countProduct($query)
    {
        $str = $query->queryString;
        $pattern = "/SELECT.*AS price/s";
        $newStr = preg_replace($pattern, "SELECT count(DISTINCT id_produit) AS productNbr", $str);
        $pattern = "/ORDER.*/s";
        $newStr = preg_replace($pattern, "", $newStr);
        $req = $this->getBdd()->prepare($newStr);
        $req->execute();
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);
        $productNbr = $data[0]['productNbr'];
        return $productNbr;
    }

    public function getProductsPerPage()
    {
        return $this->_productsPerPage;
    }
}
