<?php


namespace floor12\DalliApi\Models;


class Item extends XmlObject
{
    /** @var int */
    protected $_quantity = 1;
    /** @var int */
    protected $_mass;
    /** @var int */
    protected $_retprice;
    /** @var int */
    protected $_barcode;
    /** @var string */
    protected $_article;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->_quantity;
    }

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
     * @return int
     */
    public function getMass(): int
    {
        return $this->_mass;
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
     * @return int
     */
    public function getRetprice(): int
    {
        return $this->_retprice;
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
     * @return int
     */
    public function getBarcode(): int
    {
        return $this->_barcode;
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
     * @return string
     */
    public function getArticle(): string
    {
        return $this->_article;
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
