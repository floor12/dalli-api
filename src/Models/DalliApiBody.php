<?php


namespace floor12\DalliApi\Models;


use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

class DalliApiBody extends BaseXmlObject
{
    /** @var string */
    protected $authToken;
    /** @var string */
    protected $apiMethodName = 'testMehod';
    /** @var SimpleXMLElement */
    protected $mainElement;

    public function __construct(string $apiMethodName, string $authToken)
    {
        $this->apiMethodName = $apiMethodName;
        $this->authToken = $authToken;
        $this->mainElement = new SimpleXMLElement("<$this->apiMethodName></$this->apiMethodName>");
        $auth = $this->mainElement->addChild('auth');
        $auth->addAttribute('token', $this->authToken);
    }

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
     * @throws ReflectionException
     */
    public function getAsXmlString(BaseXmlObject $object = null): string
    {
        return $this->mainElement->asXML();
    }

    /**
     * @param string $authToken
     * @return self
     */
    public function setAuthToken(string $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @param string $apiMethodName
     * @return self
     */
    public function setApiMethodName(string $apiMethodName): self
    {
        $this->apiMethodName = $apiMethodName;
        return $this;
    }
}
