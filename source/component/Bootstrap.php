<?php

namespace Underwear\Component;

class Bootstrap
{
    
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
                    $this->load($file);
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
                    $this->load($file);
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
