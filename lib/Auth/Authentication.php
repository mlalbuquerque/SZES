<?php

namespace Auth;

class Authentication
{
    
    private $session;
    
    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $sessionObject)
    {
        $this->session = $sessionObject;
    }
    
    public function isAuthenticated()
    {
        return $this->session->has('user');
    }
    
    // Modifique este método como quiser
    public function getUser()
    {
        $user = new \Model\Usuario();

        return $user;
    }
    
}
