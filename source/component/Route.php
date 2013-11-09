<?php

namespace Underwear\Component;

class Route
{

    private $path;
    private $controller;
    private $action;
    private $httpMethod;
    private $caseSensitive;

    public function __construct($path, $controller, $action, $httpMethod, $caseSensitivity = false)
    {
        $this->setPath($path);
        $this->setController($controller);
        $this->setAction($action);
        $this->setHttpMethod($httpMethod);
        $this->setCaseSensitivity($caseSensitivity);
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
    
    private function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }
    
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    private function setCaseSensitivity($caseSensitivity)
    {
        $this->caseSensitive = $caseSensitivity;
    }
    
    public function getCaseSensitivity()
    {
        return $this->caseSensitive;
    }
    
}

?>
