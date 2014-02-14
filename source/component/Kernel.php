<?php

namespace Underwear\Component;

class Kernel
{

    private $booted;
    
    const NAME = "";
    const VERSION_MAJOR = "0";
    const VERSION_MINOR = "1";
    const BUILD = "";
    const COMMIT = "";
    
    public function __construct()
    {
        // do we do anything here?
    }
    
    // Boot The Kernel

    public function boot()
    {
        // this loads the needed controller
        // register the routers in the router table
        
        $this->booted = true;
        
    }
    
    // Handle The Request
    
    public function handle(\Underwear\Component\AbstractRequest $abstractRequest)
    {
        // Handle the request
        $uri = $abstractRequest->getUri();
        $routeTable = (include APP_CONFIG_DIRECTORY . DIRECTORY_SEPARATOR . 'routing' . FILE_EXTENSION);
        $router = new \Underwear\Component\Router();
        $router->register($routeTable);
        $controller = $router->getController($uri);
        $response = $this->dispatch($controller);
        return $response;
        
    }
    
    // Dispatch The Controller

    private function dispatch($controller)
    {
        // This dispatches the controller.
        // If a controller isn't found, this should return a "404 Not Found" response.
        
        if ($controller == false) {
            $response = new \Underwear\Component\Response("",\Underwear\Component\Response::HTTP_NOT_FOUND);
            return $response;
        }
        else {
            \Underwear\Component\Loader::load( APP_CONTROLLER_DIRECTORY . DIRECTORY_SEPARATOR . $controller["controller"] . FILE_EXTENSION );
            $fcontroller = $controller["controller"];
            $fmethod = $controller["action"];
            $fargs = $controller["args"];
            $response = call_user_func_array(array($fcontroller,$fmethod),$fargs);
            return $response;
        }
        
    }
    
    // Shutdown The Kernel
    
    public function shutdown()
    {
        // here unload the loaded app controller
        // or does it? what does this do really?
        
        if ($this->booted) {
            $this->booted = false;
        }
        
    }

}

?>
