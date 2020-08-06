<?php


namespace floor12\DalliApi\Models;


use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

class XmlObject
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
            if (empty($attributeValue))
                continue;
            /** @var $attributeValue Receiver */
            if (is_object($attributeValue)) {
                $newXmlObject = $mainElement->addChild($attributeValue->getAsXmlObject()->getName());
                foreach ($attributeValue->getAsXmlObject()->children() as $child)
                    $newXmlObject->addChild($child->getName(), $child);
            } else {
                if (substr($attributeName, 0, 1) === '_') {
                    $mainElement->addAttribute(substr($attributeName, 1), $attributeValue);
                } else {
                    $mainElement->addChild($attributeName, $attributeValue);
                }
            }
        }
        return $mainElement;
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
