<?php

namespace Underwear\Core;

class Controller
{

    private $name;      // controller name
    private $action;    // controller action
    private $args;      // controller arguments

    public function run()
    {
        $response = call_user_func_array(
            array(
                $this->getName(),
                $this->getAction()
            ) ,
            $this->getArgs()
        );
        
        return $response;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setAction($action)
    {
        $this->action = $action;
    }
    
    public function getAction()
    {
        return $this->action;
    }
    
    public function setArgs($args)
    {
        $this->args = $args;
    }
    
    public function getArgs()
    {
        return $this->args;
    }

}

?>