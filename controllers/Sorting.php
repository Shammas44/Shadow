<?php
declare (strict_types = 1);
namespace controllers;

class Sorting
{
    private $_sorting;
    private $_sortingName;
    private $_modelProduct;
    private $_viewHompage;
    private $_productData;
    private $_filterData;

    public function __construct($sorting, $sortingName, $filterData, $model)
    {
        $this->_sorting = $sorting;
        $this->_sortingName = $sortingName;
        $this->_filterData = $filterData;
        $this->_modelProduct = $model;
        $this->products();
    }

    private function products()
    {
        $all = $this->_modelProduct->getProduct($this->_sorting, $this->_filterData);
        $products = $all['products'];
        $nbrProducts = $all['productNbr'];
        $noPage = $this->_modelProduct->getUrlParam('page');
        $productsPerPage = $this->_modelProduct->getProductsPerPage();
        $pagesNumber = ceil($nbrProducts / $productsPerPage);
        $this->_viewHompage = new \views\View('Accueil');
        $this->_productData = $this->_viewHompage->generate(array(
            'products' => $products,
            'nbrProducts' => $nbrProducts,
            'pagesNbr' => $pagesNumber,
            'sorting' => $this->_sortingName,
            'noPage' => $noPage));
    }

    public function productData()
    {
        return $this->_productData;
    }
}
