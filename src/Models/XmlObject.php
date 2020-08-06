<?php


namespace floor12\DalliApi\Models;


use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

abstract class XmlObject
{

    /**
     * @return SimpleXMLElement
     * @throws ReflectionException
     */
    public function getAsXmlObject(): SimpleXMLElement
    {
        $className = mb_strtolower((new ReflectionClass($this))->getShortName());
        $mainElement = new SimpleXMLElement("<$className></$className>");
        foreach ($this as $attributeName => $attributeValue) {
            $this->processAttributeNameAndValue($mainElement, $attributeName, $attributeValue);
        }
        return $mainElement;
    }

    /**
     * @param $mainElement
     * @param $attributeName
     * @param $attributeValue
     */
    protected function processAttributeNameAndValue($mainElement, $attributeName, $attributeValue): void
    {
        if (empty($attributeValue))
            return;
        if (is_array($attributeValue)) {
            $this->addValueAsArray($mainElement, $attributeName, $attributeValue);
        } elseif (is_object($attributeValue)) {
            $this->addValueAsObject($mainElement, $attributeValue);
        } else {
            $this->addValueAsString($mainElement, $attributeName, $attributeValue);
        }
    }

    /**
     * @param $mainElement
     * @param $attributeName
     * @param $attributeValue
     */
    protected function addValueAsArray($mainElement, $attributeName, $attributeValue)
    {
        $itemsElement = $mainElement->addChild($attributeName);
        foreach ($attributeValue as $item) {
            $itemElement = $itemsElement->addChild($item->getAsXmlObject()->getName(), $item->getAsXmlObject());
            foreach ($item as $itemAttributeName => $itemAttributeValue) {
                $this->addValueAsString($itemElement, $itemAttributeName, $itemAttributeValue);
            }
        }
    }

    /**
     * @param $mainElement
     * @param $attributeValue
     */
    protected function addValueAsObject($mainElement, $attributeValue)
    {
        $newXmlObject = $mainElement->addChild($attributeValue->getAsXmlObject()->getName());
        foreach ($attributeValue->getAsXmlObject()->children() as $child)
            $newXmlObject->addChild($child->getName(), $child);
    }

    /**
     * @param $mainElement
     * @param $attributeName
     * @param $attributeValue
     * @return null
     */
    protected function addValueAsString($mainElement, $attributeName, $attributeValue)
    {
        if (empty($attributeValue))
            return null;
        if (substr($attributeName, 0, 1) === '_') {
            return $mainElement->addAttribute(substr($attributeName, 1), $attributeValue);
        } else {
            return $mainElement->addChild($attributeName, $attributeValue);
        }
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function getAsXmlString(): string
    {
        return $this->getAsXmlObject()->asXML();
    }
}
