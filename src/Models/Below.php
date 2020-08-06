<?php


namespace floor12\DalliApi\Models;


class Below extends XmlObject
{
    /** @var float */
    protected $_above_price;
    /** @var float */
    protected $_return_price;
    /** @var int */
    protected $_below;
    /** @var float */
    protected $_below_sum;
    /** @var float */
    protected $_price;

    /**
     * @return float
     */
    public function getAbovePrice(): float
    {
        return $this->_above_price;
    }

    /**
     * @param float $above_price
     * @return Below
     * @return Below
     */
    public function setAbovePrice(float $above_price): self
    {
        $this->_above_price = $above_price;
        return $this;
    }

    /**
     * @return float
     */
    public function getReturnPrice(): float
    {
        return $this->_return_price;
    }

    /**
     * @param float $return_price
     * @return Below
     * @return Below
     */
    public function setReturnPrice(float $return_price): self
    {
        $this->_return_price = $return_price;
        return $this;
    }

    /**
     * @return int
     */
    public function getBelow(): int
    {
        return $this->_below;
    }

    /**
     * @param int $below
     * @return Below
     * @return Below
     */
    public function setBelow(int $below): self
    {
        $this->_below = $below;
        return $this;
    }

    /**
     * @return float
     */
    public function getBelowSum(): float
    {
        return $this->_below_sum;
    }

    /**
     * @param float $below_sum
     * @return Below
     * @return Below
     */
    public function setBelowSum(float $below_sum): self
    {
        $this->_below_sum = $below_sum;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->_price;
    }

    /**
     * @param float $price
     * @return Below
     * @return Below
     */
    public function setPrice(float $price): self
    {
        $this->_price = $price;
        return $this;
    }

}
