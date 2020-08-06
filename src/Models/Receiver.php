<?php

namespace floor12\DalliApi\Models;


class Receiver extends XmlObject
{
    /** @var string */
    protected $town;
    /** @var string */
    protected $address;
    /** @var string */
    protected $person;
    /** @var string */
    protected $phone;
    /** @var string */
    protected $date;
    /** @var string */
    protected $time_min;
    /** @var string */
    protected $time_max;
    /** @var string */
    protected $zipcode;

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

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
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
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
     * @return string
     */
    public function getPerson(): string
    {
        return $this->person;
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
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
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
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
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
     * @return string
     */
    public function getTimeMin(): string
    {
        return $this->time_min;
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
     * @return string
     */
    public function getTimeMax(): string
    {
        return $this->time_max;
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
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
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
