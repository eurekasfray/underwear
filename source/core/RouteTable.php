<?php

namespace Underwear\Core;

class RouteTable
{

    private $record; // Stores table records. A record has two fields: route-name field; and the route-object field.
    
    // Initiate the table record storage.
    
    public function __construct()
    {
        $this->record = array();
    }
    
    // Create and append new record to table.
    // This behaviour takes as input two pieces of information---a Route object,
    // and a name used to identify the route.
    
    public function add($name, \Underwear\Core\Route $route)
    {    
        // Append record to table, and store given name and given route.
        // Then, save record hash, which shall be identifiable by the given name
        $this->record[$name] = $route;
    }
    
    // Get the entire table of routes.
    // This behaviour returns the entire table. It takes no input, nor does it
    // return any value.
    
    public function getRouteRecords()
    {
        return $this->record;
    }
    
    // Get Route By Name
    
    public function getRoute($name)
    {
        // Search the route table for the given name
        if (!empty( $this->record[$name] )) {
            return $this->record[$name];
        }
        else {
            return null;
        }
    }
    
}

?>