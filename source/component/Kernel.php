<?php

namespace Underwear\Component;

class Kernel
{

    private $booted;
    
    const NAME = "";
    const VERSION_MAJOR = "0";
    const VERSION_MINOR = "1"; 
    const COMMIT = "";
    
    public function __construct()
    {
        // do we do anything here?
    }

    public function boot()
    {
        // this loads the needed controller
        // register the routers in the router table
        
        $this->booted = true;
    }
    
    public function handle(\Underwear\Component\Request $request)
    {
        // Handle the request
        $uri = $request->getUri();
      //$routeTable = \Underwear\Component\Loader::load(APP_CONFIG_DIRECTORY . DIRECTORY_SEPARATOR . "routing" . FILE_EXTENSION);
        $routeTable = new \Underwear\Component\RouteTable();
        $routeTable->add("testpage", new \Underwear\Component\Route("/test","Homepage","show","GET"));
        $routeTable->add("homepage", new \Underwear\Component\Route("/","Homepage","show","GET"));
        $router = new \Underwear\Component\Router();
        $router->register($routeTable);
        $controller = $router->getController($uri);
        $response = $this->dispatch($controller);
        return $response;
    }

    private function dispatch($controller)
    {
        // This dispatches the controller.
        // If a controller isn't found, this should return a "404 Not Found" response.
        
        if ($controller == false) {
            $response = new \Underwear\Component\Response("<h1>404 Not Found</h1>", \Underwear\Component\Response::HTTP_NOT_FOUND);
            return $response;
        }
        else {
            \Underwear\Component\Loader::load(APPLICATION_DIRECTORY . DIRECTORY_SEPARATOR . "controller" . DIRECTORY_SEPARATOR . $controller["controller"] . "Controller" . FILE_EXTENSION);
            $fcontroller = $controller["controller"] . "Controller";
            $fmethod = $controller["action"];
            $response = call_user_func_array(array($fcontroller,$fmethod),array("Underwear"));
            return $response;
        }
    }
    
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
