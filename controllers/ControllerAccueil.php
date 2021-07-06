<?php
declare (strict_types = 1);
namespace controllers;

class ControllerAccueil
{
    private $_modelProduct;
    private $_viewHompage;
    private $_productData;
    private $_filter;
    private $_viewFilter;
    private $_filterData;

    public function __construct($url)
    {
        if (isset($url) && $url != "") {
            throw new Exception('Page introuvable');
        } else {
            $this->_modelProduct = new \models\ModelProduct;

            $this->products();
            $this->filters();
            $this->getTemplate();
        }
    }

    private function products()
    {
        $sortingModel = new \models\ModelSorting;
        $sortingData = $sortingModel->getSorting();
        $all = '';
        if (!empty($sortingData)) {
            $all = $this->_modelProduct->getProduct($sortingData['sorting'], $sortingData['whereClause']);
            $sorting = $sortingData['sortingName'];
        } else {
            $all = $this->_modelProduct->getProduct();
            $sorting = 'Prix';
        }

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
            'sorting' => $sorting,
            'noPage' => $noPage));
    }

    private function filters()
    {
        $this->_filter = new \models\Filter;
        $filters = $this->_filter->getFilter();
        $this->_viewFilter = new \views\View('Filter');
        $this->_filterData = $this->_viewFilter->generate(array('filters' => $filters));
    }

    private function getTemplate()
    {
        $template = new \views\view('Accueil');
        $data = array(
            'product' => $this->_productData,
            'filter' => $this->_filterData);
        $template->generateTemplate($data);
    }
}
