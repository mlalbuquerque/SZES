<?php

namespace Model;

class Entity
{
    
    public function fromArray(array $values)
    {
        foreach ($values as $attribute => $value)
            if (property_exists($this, $attribute))
            {
                $attribute = \Util\Text::sanitizeAttributeName($attribute);
                $this->$attribute = $value;
            }
    }
    
    private function getAttributeFromMethod($method)
    {
        return strtolower(substr($method, 3));
    }
    
}