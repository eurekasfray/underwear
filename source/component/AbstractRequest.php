<?php

namespace Underwear\Component;

class AbstractRequest
{

    public $method;
    public $uri;
    
    public function __construct()
    {
    }
    
    public function setMethod($method)
    {
        $this->method = $method;
    }
    
    public function setUri($uri)
    {
        $this->uri = $uri;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function getUri()
    {
        return $this->uri;
    }

}