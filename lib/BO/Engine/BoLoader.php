<?php

namespace BO\Engine;

class BoLoader implements \ArrayAccess
{
    
    protected $dao, $container;

    public function __construct(\Model\DAO\Engine\DaoLoader $dao)
    {
        $this->dao = $dao;
        $this->container = array();
    }
    
    public function offsetExists($bo_name)
    {
        return array_key_exists($bo_name, $this->container);
    }
    
    public function offsetGet($bo_name)
    {
        if (!array_key_exists($bo_name, $this->container))
        {
            $class = "BO\\$bo_name";
            $this->container[$bo_name] = new $class($this->dao);
        }
        
        return $this->container[$bo_name];
    }

    public function offsetSet($bo_name, $bo)
    {
        if (!is_object($bo))
            throw new Exception('Second argument must be an object!');
        
        $this->container[$bo_name] = $bo;
    }

    public function offsetUnset($bo_name)
    {
        unset($this->container[$bo_name]);
    }
}
