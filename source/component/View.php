<?php

namespace Underwear\Component;

class View
{

    // A question to myself: What is a view? A view is a part of the presentation logic.
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
        // Function not ready for use
        
        $this->_data[$name] = $value;
    }
    
    public function __get($name)
    {
        // Function not ready for use
        
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
    }
    
    public function template($file)
    {
        // Function not ready for use
    }
    
    public function render($file, array $args)
    {
        // This method should return a string because its return will be passed on to the Response as content
        // The rendering process does not involve displaying code, but instead means to simply render the template with its fill-in information.
        
        extract($args);
        ob_start();
        require(APP_TEMPLATE_DIRECTORY . DIRECTORY_SEPARATOR . $file);
        $html = ob_get_clean();
        
        return $html;
    }

}

?>
