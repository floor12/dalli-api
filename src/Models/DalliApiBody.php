<?php

namespace floor12\DalliApi\Models;

use floor12\DalliApi\Exceptions\EmptyApiMethodException;
use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

class DalliApiBody extends BaseXmlObject
{
    /** @var string */
    protected $authToken;
    /** @var string */
    protected $apiMethodName;
    /** @var SimpleXMLElement */
    public $mainElement;

    /**
     * DalliApiBody constructor.
     * @param string|null $apiMethodName
     * @throws EmptyApiMethodException
     */
    public function __construct(?string $apiMethodName)
    {
        if (empty($apiMethodName))
            throw new EmptyApiMethodException();

        $this->apiMethodName = $apiMethodName;
        $this->mainElement = new SimpleXMLElement("<$this->apiMethodName></$this->apiMethodName>");
    }

    /**
     * @param BaseXmlObject $object
     * @return $this
     * @throws ReflectionException
     */
    public function add(BaseXmlObject $object): self
    {
        $className = mb_strtolower((new ReflectionClass($object))->getShortName());
        $mainElement = $this->mainElement->addChild($className);
        foreach ($object as $attributeName => $attributeValue) {
            $this->processAttributeNameAndValue($mainElement, $attributeName, $attributeValue);
        }
        return $this;
    }

    /**
     * @param BaseXmlObject|null $object
     * @return string
     */
    public function getAsXmlString(BaseXmlObject $object = null): string
    {
        return $this->mainElement->asXML();
    }
}
