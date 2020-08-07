<?php


namespace floor12\DalliApi\Models;


class Below extends BaseXmlObject
{
    /** @var float */
    public $_above_price;
    /** @var float */
    public $_return_price;
    /** @var int */
    public $_below;
    /** @var float */
    public $_below_sum;
    /** @var float */
    public $_price;

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
