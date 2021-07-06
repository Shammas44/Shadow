<?php
declare (strict_types = 1);
namespace models;

class Filter
{
    private static $_modelFilter;
    private $_material;
    private $_color;
    private $_brand;
    private $_type;
    private $_price;

    public function __construct()
    {
        self::$_modelFilter = new \models\ModelFilter;
        $this->_material = self::$_modelFilter->getMaterial();
        $this->_color = self::$_modelFilter->getColor();
        $this->_brand = self::$_modelFilter->getBrand();
        $this->_type = self::$_modelFilter->getType();
        $this->_price = self::$_modelFilter->getPrice();
    }

    public function getFilter(): array
    {
        $filter = array(
            "type" => $this->_type,
            "price" => $this->_price,
            "brand" => $this->_brand,
            "color" => $this->_color,
            "material" => $this->_material);
        return $filter;
    }

}
