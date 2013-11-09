<?php

class HomepageController
{

    public function show($name)
    {
        $msg = "Hello, " . $name;
        return new \Underwear\Component\Response($msg);
    }
  
}

?>