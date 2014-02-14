<?php

namespace Underwear\Component;

class ServerGlobals
{

    // This is in attempts to isolate the app from globals. Why? Idk.
    
    public function __construct()
    {
    }
    
    public function createGetGlobal()
    {
        $get = new \Underwear\Component\Bag();
    
        foreach ($_GET as $key=>$value) {
            $get->add($key,$value);
        }
        
        return $get;
    }
    
    public function createPostGlobal()
    {
        $post = new \Underwear\Component\Bag();
    
        foreach ($_POST as $key=>$value) {
            $post->add($key,$value);
        }
        
        return $post;
    }
    
    public function createServerGlobal()
    {
        $server = new \Underwear\Component\Bag();
    
        foreach ($_SERVER as $key=>$value) {
            $server->add($key,$value);
        }
        
        return $server;
    }
    
    public function createFilesGlobal()
    {
        $files = new \Underwear\Component\Bag();
    
        foreach ($_FILES as $key=>$value) {
            $files->add($key,$value);
        }
        
        return $files;
    }
    
    public function createCookieGlobal()
    {
        $cookie = new \Underwear\Component\Bag();
    
        foreach ($_COOKIE as $key=>$value) {
            $cookie->add($key,$value);
        }
        
        return $cookie;
    }

}