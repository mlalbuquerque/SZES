<?php

namespace Log;

class SilexSkeletonLogger implements \Doctrine\DBAL\Logging\SQLLogger
{
    
    private $session, $logger;
    
    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $sessionObject,
                                \Monolog\Logger $loggerObject)
    {
        $this->session = $sessionObject;
        $this->logger = $loggerObject;
    }
    
    public function startQuery($sql, array $params = null, array $types = null){
        $p = implode(', ', $params);
        $t = implode(', ', $types);
        $this->logger->addDebug('SQL: ' . $sql . '; params: [' . $p . ']; tipos: [' . $t . ']');
    }
    
    public function stopQuery()
    {
        
    }
    
}