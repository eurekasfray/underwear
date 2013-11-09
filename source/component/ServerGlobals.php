<?php

namespace Underwear\Component;

class ServerGlobals
{

    // This is in attemtps to isolate the app from globals

    public static $server;
    
    public function __construct()
    {
        foreach ($_SERVER as $key=>$value) {
            $this->server[$key] = $value;
        }
    }

}