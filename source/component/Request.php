<?php

namespace Underwear\Component;

class Request
{
    public $get;
    public $post;
    public $server;
    public $files;
    public $cookies;
    public $headers;
    
    public function __construct()
    {
        $superglobals= new \Underwear\Component\ServerGlobals();
        $this->get = $superglobals->createGetGlobal();
        $this->post = $superglobals->createPostGlobal();
        $this->server = $superglobals->createServerGlobal();
        $this->files = $superglobals->createFilesGlobal();
        $this->cookie = $superglobals->createCookieGlobal();
        $this->normalizeUri();
    }

    public function synthesize()
    {
        $abstractRequest = new \Underwear\Component\AbstractRequest();
        
        $abstractRequest->setMethod($this->getMethod());
        $abstractRequest->setUri($this->getNormalizedUri());
        
        return $abstractRequest;
        
    }
    
    public function getMethod()
    {
        return $this->server->get("REQUEST_METHOD");
    }
    
    public function getRawUri()
    {
        return $this->server->get("REQUEST_URI");
    }
    
    public function getNormalizedUri()
    {
        return $this->server->get("NORMALIZED_REQUEST_URI");
    }
    
    public function getHeaders()
    {
    }
    
    // Normalize URI by removing fragment and query strings in order for the Router
    
    public function normalizeUri()
    {
        // Get raw URI
    
        $uri = $this->getRawUri();
        
        // Get Rid Of Fragment Component (If Any)
        
        $indexof = strpos($uri,'#');
        
        if ($indexof != false) {
            $uri = substr($uri,0,$indexof); // remove fragment component
        }
        
        // Get Query String And Remove It From URI In Order To Normalize URI
        
        $indexof = strpos($uri,'?');
        
        if ($indexof != false) {
            $queryString = substr($uri, ($indexof+1), (strlen($uri)-1)); // get query string
            $this->server->add("QUERY_STRING",$queryString); // save query string to SERVER superglobal
            $uri = substr($uri,0,$indexof);    // remove query string from URI
            $this->server->add("NORMALIZED_REQUEST_URI",$uri); // save normalized URI to SERVER superglobal
        }
        else {
            // No query string? Then, save URI as is to SERVER superglobal
            $this->server->add("NORMALIZED_REQUEST_URI",$uri); 
        }
    }

}

?>
