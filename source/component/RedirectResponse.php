<?php

/*
namespace Underwear\Component;

class RedirectResponse extends Response  // to fix the error here, we have to preload Response as it has not been loaded yet, because "RedirectResponse" alphabetically appears before "Response"
{
    private $location;
    private $status;

    public function __construct($location, $status = SELF::HTTP_FOUND)
    {
        $this->setLocation($location);
        $this->setStatus($location);
    }
    
    private function setLocation($location)
    {
        $this->location = $location;
    }
    
    private function getLocation()
    {
        return $this->location;
    }
    
    private function setStatus($status)
    {
        $this->status = $status;
    }
    
    private function getStatus()
    {
        return $this->status;
    }
    
    public function send()
    {
        
        die();
    }

}
*/