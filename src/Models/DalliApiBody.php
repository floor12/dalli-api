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
    /** @var array|null */
    private $params;

    public $user_id;
    public $order_id;

    /**
     * DalliApiBody constructor.
     * @param string|null $apiMethodName
     * @param array|null $params
     * @throws EmptyApiMethodException
     */
    public function __construct(?string $apiMethodName, ?array $params = [], ?int $user_id = null, ?int $order_id = null)
    {
        if (empty($apiMethodName))
            throw new EmptyApiMethodException();

        $this->apiMethodName = $apiMethodName;
        $this->mainElement = new SimpleXMLElement("<$this->apiMethodName></$this->apiMethodName>");
        $this->params = $params;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
        $this->parseParamsToXml();
    }


    private function parseParamsToXml(): void
    {
        if (empty($this->params))
            return;
        $this->addParamArrayToElement($this->mainElement, $this->params);
    }

    /**
     * @param SimpleXMLElement $element
     * @param array $paramsArray
     */
    private function addParamArrayToElement(SimpleXMLElement $element, array $paramsArray): void
    {
        foreach ($paramsArray as $paramName => $paramValue) {
            $child = $element->addChild($paramName);
            if (is_array($paramValue)) {
                $this->addParamArrayToElement($child, $paramValue);
            } else {
                $child[0] = $paramValue;
            }
        }
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
