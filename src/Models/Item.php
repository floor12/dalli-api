<?php


namespace floor12\DalliApi\Models;


class Item extends BaseXmlObject
{
    /** @var string */
    public $title;
    /** @var int */
    public $_quantity = 1;
    /** @var int */
    public $_weight;
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
     * @param int $_weight
     * @return Item
     * @return Item
     */
    public function setweight(int $_weight)
    {
        $this->_weight = $_weight;
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

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
}
