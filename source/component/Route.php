<?php

namespace Underwear\Component;

class Route
{

    private $path;
    private $controller;
    private $action;
    private $method;
    private $caseSensitivity;

    public function __construct($path, $controller, $action, $method, $caseSensitivity = CASE_INSENSITIVE)
    {
        $this->setPath($path);
        $this->setController($controller);
        $this->setAction($action);
        $this->setmethod($method);
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
    
    private function setMethod($method)
    {
        $this->method = $method;
    }
    
    public function getMethod()
    {
        return $this->method;
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
