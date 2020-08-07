<?php


namespace floor12\DalliApi\Models;


use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;
use yii\base\ErrorException;

class DalliApiBody extends BaseXmlObject
{
    /** @var string */
    protected $authToken;
    /** @var string */
    protected $apiMethodName = 'testMehod';
    /** @var SimpleXMLElement */
    protected $mainElement;

    public function __construct(?string $apiMethodName, ?string $authToken)
    {
        if (empty($apiMethodName))
            throw new ErrorException('Api method name is empty.');

        if (empty($authToken))
            throw new ErrorException('Auth token is empty.');
        
        $this->apiMethodName = $apiMethodName;
        $this->authToken = $authToken;
        $this->mainElement = new SimpleXMLElement("<$this->apiMethodName></$this->apiMethodName>");
        $auth = $this->mainElement->addChild('auth');
        $auth->addAttribute('token', $this->authToken);
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
