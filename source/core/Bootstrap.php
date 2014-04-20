<?php

// TODO: Make improvements to this. make its methods more modular. there are duplicate style of code in loadComponents(), loadServices(), and loadCore(). that doesn't be. have something kind of loadAll() that does the walk through of all directories or something.

namespace Underwear\Core;

class Bootstrap
{
    
    public function loadCore()
    {
        $classes = scandir(CORE_DIRECTORY,0);
        if (count($classes) == 0) {
            throw new \Exception("Missing core: Empty directory");
        }
        else {
            foreach ($classes as $file) {
                if (is_dir($file)) {
                    continue;
                }
                else {
                    $this->load( CORE_DIRECTORY . DIRECTORY_SEPARATOR . $file );
                }
            }
        }
    }
    
    public function loadComponents()
    {
        $classes = scandir(COMPONENT_DIRECTORY,0);
        if (count($classes) == 0) {
            throw new \Exception("Missing components: Empty directory");
        }
        else {
            foreach ($classes as $file) {
                if (is_dir($file)) {
                    continue;
                }
                else {
                    $this->load( COMPONENT_DIRECTORY . DIRECTORY_SEPARATOR . $file );
                }
            }
        }
    }
    
    public function loadServices()
    {
        $classes = scandir(SERVICE_DIRECTORY,0);
        if (count($classes) == 0) {
            throw new \Exception("Missing services: Empty directory");
        }
        else {
            foreach ($classes as $file) {
                if (is_dir($file)) {
                    continue;
                }
                else {
                    $this->load( SERVICE_DIRECTORY . DIRECTORY_SEPARATOR . $file );
                }
            }
        }
    }
    
    private function load($path)
    {
        require_once($path);
    }
    
}

?>
