<?php


namespace floor12\DalliApi\Models;


use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

abstract class BaseXmlObject
{
    /**
     * @param BaseXmlObject|null $object
     * @return SimpleXMLElement
     * @throws ReflectionException
     */
    public function getAsXmlObject(BaseXmlObject $object = null): SimpleXMLElement
    {
        if (empty($object)) {
            $object = $this;
        }
        $className = mb_strtolower((new ReflectionClass($object))->getShortName());
        $mainElement = new SimpleXMLElement("<$className></$className>");
        foreach ($object as $attributeName => $attributeValue) {
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
     * @param SimpleXMLElement $mainElement
     * @param $attributeName
     * @param $attributeValue
     * @return void
     */
    protected function addValueAsString(SimpleXMLElement $mainElement, $attributeName, $attributeValue): void
    {
        if (empty($attributeValue))
            return;
        if ($attributeName === 'title') {
            $mainElement[0] = $attributeValue;
        } elseif (substr($attributeName, 0, 1) === '_') {
            $mainElement->addAttribute(substr($attributeName, 1), $attributeValue);
        } else {
            $mainElement->addChild($attributeName, $attributeValue);
        }
    }

    /**
     * @param BaseXmlObject|null $object
     * @return string
     * @throws ReflectionException
     */
    public function getAsXmlString(BaseXmlObject $object = null): string
    {
        return $this->getAsXmlObject($object)->asXML();
    }
}
