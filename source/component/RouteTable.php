<?php

namespace Underwear\Component;

class RouteTable
{

    private $records;
    
    public function __construct()
    {
        $this->records = array();
    }
    
    public function add($name, \Underwear\Component\Route $route)
    {
        $this->records[$name] = $route;
    }
    
    public function getTable()
    {
        return $this->records;
    }
    
}

?>