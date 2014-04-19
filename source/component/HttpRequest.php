<?php

namespace Underwear\Component;

class HttpRequest
{

    public $scheme;   // The scheme of the request (http or https)
    public $body;     // The raw HTTP-request body as a string
    public $path;     // The normalized URI path (example: /page/home/)
    public $method;   // The request method 
    
    public $get;      // The GET bag
    public $post;     // Stores POST
    public $server;   // ...
    public $files;    // ...
    public $cookies;  // ...
    public $headers;  // ...
    
    public function __construct()
    {
        $globals = new \Underwear\Component\Globals();
        $normalizer = new \Underwear\Core\Normalizer();
        $this->get = $globals->createGetBag();
        $this->post = $globals->createPostBag();
        $this->server = $globals->createServerBag();
        $this->files = $globals->createFilesBag();
        $this->cookie = $globals->createCookieBag();
        $this->headers = $globals->createHeadersBag(); // what are headers and why are they necessary here ???
        $this->scheme = $this->determineScheme();
        $this->path = $normalizer->normalizePath($this->server->get("REQUEST_URI"));
        $this->method = $this->server->get("REQUEST_METHOD");
        $this->body = null;
    }
    
    public function getScheme()
    {
        return $this->scheme;
    }
    
    private function determineScheme() {
        
        $schemeIndicator = $this->server->get("HTTPS");
        if (!empty($schemeIndicator)) {
            return "https";
        }
        else {
            return "http";
        }
    }
    
    public function getBody()
    {
        return http_get_request_body();
    }
    
    public function getPath()
    {
        return $this->path;
    }
    
    public function getMethod()
    {
        return $this->server->get("REQUEST_METHOD");
    }
    
    public function getGet()
    {
    }
    
    public function getPost()
    {
    }
    
    public function getServer()
    {
    }
    
    public function getFiles()
    {
    }
    
    public function getCookies()
    {
    }
    
    public function getHeaders()
    {
    }

}

?>
