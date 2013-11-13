<?php

class HomepageController
{

    public function show($name)
    {
        $msg = "Hello, " . $name;
        return new \Underwear\Component\Response($msg);
    }
    
    public function showPage()
    {
        $content = "Welcome to the homepage!";
        return new \Underwear\Component\Response($content);
    }
  
}

?>