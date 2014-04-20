<?php

namespace Underwear\Core;

class Route
{

    private $path;
    private $controller;
    private $action;
    private $method;
    private $caseSensitivity;

    public function __construct($method, $path, $controller, $action, $caseSensitivity = CASE_INSENSITIVE)
    {
        // Note: The route paths are normalized upon the creation of a Route object.
        
        $normalizer = new \Underwear\Core\Normalizer();
        $this->setmethod($method);
        $this->setPath($normalizer->normalizePath($path));
        $this->setController($controller);
        $this->setAction($action);
        $this->setCaseSensitivity($caseSensitivity);
    }
    
    private function setMethod($method)
    {
        $this->method = $method;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    private function setPath($path)
    {
        $this->path = $path;
    }
    
    public function getPath()
    {
        return $this->path;
    }
    
    private function setController($controller)
    {
        $this->controller = $controller;
    }
    
    public function getController()
    {
        return $this->controller;
    }
    
    private function setAction($action)
    {
        $this->action = $action;
    }
    
    public function getAction()
    {
        return $this->action;
    }

    private function setCaseSensitivity($caseSensitivity)
    {
        $this->caseSensitivity = $caseSensitivity;
    }
    
    public function getCaseSensitivity()
    {
        return $this->caseSensitivity;
    }
    
}

?>
