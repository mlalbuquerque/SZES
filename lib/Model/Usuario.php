<?php

namespace Model;

class Usuario extends User
{

    public $name, $profile;
    
    public function __toString()
    {
        return $this->name;
    }

}
