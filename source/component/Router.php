<?php

namespace Underwear\Component;

class Router
{

    // A router registers to only one table.
    
    private $registry;
    
    public function register(\Underwear\Component\RouteTable $routeTable)
    {
        $this->registry = $routeTable;
    }

    public function getController($uri)
    {
        $controller = $this->search($uri);
        return $controller;
    }
    
    public function search($uri)
    {
        $found = false;
        
        $registry = $this->registry;
        $routeTable = $registry->getTable();
        foreach ($routeTable as $name=>$route) {
            // The complex matching of URI and route path is done here. Replace this simple one:
            if ($route->getPath() == $uri) {
                $foundRoute = $route;
                $found = true;
                break;
            }
        }
        
        if ($found) {
            $controller = array ("controller"=>$foundRoute->getController(), "action"=>$foundRoute->getAction());
            return $controller;
        }
        else {
            return false;
        }
    }

}

?>
