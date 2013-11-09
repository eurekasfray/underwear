<?php

namespace Underwear\Component;

class View
{

    // A question to myslef: What is a view? A view is a part of the presentation logic.
    // -- Render templates
    // -- Generates its own object states
    // -- Assign templates
    // The view must allow the user to easily create a view, pass the template to display the content, and pass the content.
    
    private $_data = array();

    public function __construct()
    {
        // do something
    }
    
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }
    
    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
    }
    
    public function template($file)
    {
    }
    
    public function render()
    {
        // this should return a string because the string will be passsed on to the Response
    }

}

?>
