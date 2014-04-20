<?php

namespace Underwear\Component;

class Bag
{

    public $collection;

    public function __construct()
    {
    }

    public function add($key, $value)
    {
        $this->collection[$key] = $value;
    }
    
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->collection[$key];
        }
        else {
            return null;
        }
    }
    
    public function set($key,$value)
    {
        if ($this->has($key)) {
            $this->collection[$key] = $value;
            return true;
        }
        else {
            return false;
        }
    }

    public function remove($key)
    {
    }
    
    public function has($key)
    {
        $found = false;
    
        foreach ($this->collection as $index=>$value) {
            if ($key == $index) {
                $found = true;
                break;
            }
        }
        
        if ($found) {
            return true;
        }
        else {
            return false;
        }
    }    
    
    public function isEmpty()
    {
        if (count($this->collection) == 0) {
            return true;
        }
        else {
            return false;
        }
    }

}