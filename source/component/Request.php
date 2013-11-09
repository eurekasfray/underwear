<?php

namespace Underwear\Component;

class Request
{

    public static $requestLine;
    private static $server;

    public static function compose()
    {
        
        $server = new \Underwear\Component\ServerGlobals();
        $request = new Request();
        $request->requestLine["method"] = $server->server["REQUEST_METHOD"];
        $request->requestLine["uri"] = $server->server["REQUEST_URI"];
        $request->requestLine["protocol"] = $server->server["SERVER_PROTOCOL"];
        $request->requestLine["method"] = $server->server["REQUEST_METHOD"];
        $request->requestLine["headers"] = array (
            "accept" => $server->server["HTTP_ACCEPT"],
            //"accept-charset" => $server->server["HTTP_ACCEPT_CHARSET"],
            "accept-encoding" => $server->server["HTTP_ACCEPT_ENCODING"],
            "accept-language" => $server->server["HTTP_ACCEPT_LANGUAGE"],
            //"accept-datetime" => $server->server["?"],
            //"authorization" => $server->server[""],
            //"cache-control" => $server->server[""],
            "connection" => $server->server["HTTP_CONNECTION"],
            //"cookie" => $server->server[""],
            //"content-length" => $server->server[""],
            //"content-md5" => $server->server[""],
            //"content-type" => $server->server[""],
            //"date" => $server->server[""],
            //"expect" => $server->server[""],
            //"from" => $server->server[""],
            "host" => $server->server["HTTP_HOST"],
            //"if-match" => $server->server[""],
            //"if-modified-since" => $server->server[""],
            //"if-none-match" => $server->server[""],
            //"if-range" => $server->server[""],
            //"if-unmodified-since" => $server->server[""],
            //"max-forwards" => $server->server[""],
            //"origin" => $server->server[""],
            //"pragma" => $server->server[""],
            //"proxy-authorization" => $server->server[""],
            //"range" => $server->server[""],
            //"referer" => $server->server["HTTP_REFERER"],
            //"te" => $server->server[""],
            //"upgrade" => $server->server[""],
            "user-agent" => $server->server["HTTP_USER_AGENT"],
            //"via" => $server->server[""],
            //"warning" => $server->server[""],
        );
        return $request;
        
    }
    
    public function getMethod()
    {
    }
    
    public function getUri()
    {
        return $this->requestLine["uri"];
    }
    
    public function getHeaders()
    {
    }

}

?>