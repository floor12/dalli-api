<?php


namespace floor12\DalliApi\Models;


class Item extends BaseXmlObject
{
    /** @var int */
    public $_quantity = 1;
    /** @var int */
    public $_mass;
    /** @var int */
    public $_retprice;
    /** @var int */
    public $_barcode;
    /** @var string */
    public $_article;


    /**
     * @param int $quantity
     * @return Item
     */
    public function setQuantity(int $quantity)
    {
        $this->_quantity = $quantity;
        return $this;
    }

    /**
     * @param int $_mass
     * @return Item
     * @return Item
     */
    public function setMass(int $_mass)
    {
        $this->_mass = $_mass;
        return $this;
    }

    /**
     * @param int $retprice
     * @return Item
     * @return Item
     */
    public function setRetprice(int $retprice)
    {
        $this->_retprice = $retprice;
        return $this;
    }

    /**
     * @param int $_barcode
     * @return Item
     * @return Item
     */
    public function setBarcode(int $_barcode)
    {
        $this->_barcode = $_barcode;
        return $this;
    }

    /**
     * @param string $_article
     * @return Item
     * @return Item
     */
    public function setArticle(string $_article)
    {
        $this->_article = $_article;
        return $this;
    }
}
