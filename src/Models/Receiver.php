<?php

namespace floor12\DalliApi\Models;


class Receiver extends BaseXmlObject
{
    /** @var string */
    public $town;
    /** @var string */
    public $address;
    /** @var string */
    public $pvzcode;
    /** @var string */
    public $person;
    /** @var string */
    public $phone;
    /** @var string */
    public $date;
    /** @var string */
    public $time_min;
    /** @var string */
    public $time_max;
    /** @var string */
    public $zipcode;

    /**
     * @param string $town
     * @return Receiver
     * @return Receiver
     */
    public function setTown(string $town)
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @param string $address
     * @return Receiver
     * @return Receiver
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $pvzCode
     * @return Receiver
     * @return Receiver
     */
    public function setPvzCode(string $pvzCode)
    {
        $this->pvzcode = $pvzCode;
        return $this;
    }

    /**
     * @param string $person
     * @return Receiver
     * @return Receiver
     */
    public function setPerson(string $person)
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param string $phone
     * @return Receiver
     * @return Receiver
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $date
     * @return Receiver
     * @return Receiver
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string $time_min
     * @return Receiver
     * @return Receiver
     */
    public function setTimeMin(string $time_min)
    {
        $this->time_min = $time_min;
        return $this;
    }

    /**
     * @param string $time_max
     * @return Receiver
     * @return Receiver
     */
    public function setTimeMax(string $time_max)
    {
        $this->time_max = $time_max;
        return $this;
    }

    /**
     * @param string $zipcode
     * @return Receiver
     * @return Receiver
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }
}
