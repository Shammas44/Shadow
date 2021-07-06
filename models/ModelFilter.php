<?php
declare (strict_types = 1);
namespace models;

class ModelFilter extends ModelCommon
{

    public function getMaterial(): array
    {
        $var = [];
        $req = $this->getbdd()->prepare('SELECT m.mat_nom, COUNT(p.idx_produit) AS cnt, idx_matiere AS id
        FROM  matieres m, produits_matieres p
        WHERE m.id_matiere = p.idx_matiere
        GROUP BY p.idx_matiere
        ORDER BY m.mat_nom');
        $req->execute();
        $var = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $var;
    }

    public function getColor(): array
    {
        $var = [];
        $req = $this->getbdd()->prepare('SELECT c.cou_nom, COUNT(p.idx_produit) AS cnt, idx_couleur As id
        FROM  couleurs c, produits_couleurs p
        WHERE c.id_couleur = p.idx_couleur
        GROUP BY p.idx_couleur
        ORDER BY c.cou_nom');
        $req->execute();
        $var = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $var;
    }

    public function getBrand(): array
    {
        $var = [];
        $req = $this->getbdd()->prepare('SELECT m.mar_nom, COUNT(p.idx_marque) AS cnt, idx_marque AS id
        FROM  marques m, produits p
        WHERE m.id_marque = p.idx_marque
        GROUP BY p.idx_marque
        ORDER BY m.mar_nom');
        $req->execute();
        $var = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $var;
    }

    public function getType(): array
    {
        $var = [];
        $req = $this->getbdd()->prepare('SELECT t.typ_nom, COUNT(p.idx_type) AS cnt, idx_type AS id
        FROM  types t, produits p
        WHERE t.id_type = p.idx_type
        GROUP BY p.idx_type
        ORDER BY t.typ_nom');
        $req->execute();
        $var = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $var;
    }

    public function getPrice(): array
    {
        $var = [];
        $req = $this->getbdd()->prepare('SELECT  COUNT(id_produit) AS cnt, ech_min AS "min" ,ech_max AS "max", id_echelle_prix AS id FROM
        (SELECT p.id_produit
        ,e.id_echelle_prix, e.ech_min,ech_max
        FROM produits p, echelle_prix e
        WHERE ROUND(p.pro_prix -((p.pro_prix * p.pro_rabais) /100 ),2)  BETWEEN e.ech_min AND e.ech_max) t
        group by id_echelle_prix
        ORDER BY id');
        $req->execute();
        $var = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $var;
    }
}
