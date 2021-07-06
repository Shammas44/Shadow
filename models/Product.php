<?php
declare (strict_types = 1);
namespace models;

class Product
{
    private $_id;
    private $_name;
    private $_price;
    private $_discount;
    private $_brand;
    private $_quantity;
    private $_date;
    private $_size;
    private $_weight;
    private $_description;
    private $_type;
    private $_initialPrice;
    private $_imgNbr;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    /**
     * hydrate - initilize les propriétés de l'objet en fonction des paramètres reçus
     * @param  array $data - les propriété de l'objet
     * @return void
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    /**
     * isAvailable - vérifie si le produit est disponible
     * @return string $class - le nom de la class css à utiliser pour indiquer la disponibilité
     */
    public function isAvailable(): string
    {
        ($this->quantity() <= 2) ? $class = 'is-red' : $class = 'is-yellow';
        ($this->quantity() > 5) ? $class = 'is-green' : $class = $class;
        return $class;
    }

    // Setters
    // ==========================================================================
    private function setId($id)
    {
        if (is_string($id)) {
            $this->_id = $id;
        }
    }

    private function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    private function setPrice($price)
    {
        if (is_string($price)) {
            $this->_price = $price;
        }
    }

    private function setDiscount($discount)
    {
        if (is_string($discount)) {
            $this->_discount = $discount;
        }
    }

    private function setBrand($brand)
    {
        if (is_string($brand)) {
            $this->_brand = $brand;
        }
    }

    private function setQuantity($quantity)
    {
        if (is_string($quantity)) {
            $this->_quantity = $quantity;
        }
    }

    private function setDate($date)
    {
        if (is_string($date)) {
            $this->_date = $date;
        }
    }

    private function setSize($size)
    {
        if (is_string($size)) {
            $this->_size = $size;
        }
    }

    private function setWeight($weight)
    {
        if (is_string($weight)) {
            $this->_weight = $weight;
        }
    }

    private function setDescription($description)
    {
        if (is_string($description)) {
            $this->_description = $description;
        }
    }

    private function setType($type)
    {
        if (is_string($type)) {
            $this->_type = $type;
        }
    }

    private function setInitialPrice($initialPrice)
    {
        if (is_string($initialPrice)) {
            $this->_initialPrice = $initialPrice;
        }
    }

    private function setimgNbr($imgNbr)
    {
        if (is_string($imgNbr)) {
            $this->_imgNbr = $imgNbr;
        }
    }

    // Getters
    // ==========================================================================
    public function id()
    {
        return $this->_id;
    }

    public function name()
    {
        return $this->_name;
    }

    public function price()
    {
        return $this->_price;
    }

    public function discount()
    {
        return $this->_discount;
    }

    public function brand()
    {
        return $this->_brand;
    }

    public function quantity()
    {
        return $this->_quantity;
    }

    public function date()
    {
        return $this->_date;
    }

    public function size()
    {
        return $this->_size;
    }

    public function weight()
    {
        return $this->_weight;
    }

    public function description()
    {
        return $this->_description;
    }

    public function type()
    {
        return $this->_type;
    }

    public function initialPrice()
    {
        return $this->_initialPrice;
    }

    public function imgNbr()
    {
        return $this->_imgNbr;
    }
}
