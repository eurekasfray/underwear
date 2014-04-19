<?php

namespace Underwear\Component;

class Globals
{

    // Is in attempts to isolate the app from PHP globals?
    
    public function __construct()
    {
    }
    
    public function createGetBag()
    {
        $get = new \Underwear\Component\Bag();
    
        foreach ($_GET as $key=>$value) {
            $get->add($key,$value);
        }
        
        return $get;
    }
    
    public function createPostBag()
    {
        $post = new \Underwear\Component\Bag();
    
        foreach ($_POST as $key=>$value) {
            $post->add($key,$value);
        }
        
        return $post;
    }
    
    public function createServerBag()
    {
        $server = new \Underwear\Component\Bag();
    
        foreach ($_SERVER as $key=>$value) {
            $server->add($key,$value);
        }
        
        return $server;
    }
    
    public function createFilesBag()
    {
        $files = new \Underwear\Component\Bag();
    
        foreach ($_FILES as $key=>$value) {
            $files->add($key,$value);
        }
        
        return $files;
    }
    
    public function createCookieBag()
    {
        $cookie = new \Underwear\Component\Bag();
    
        foreach ($_COOKIE as $key=>$value) {
            $cookie->add($key,$value);
        }
        
        return $cookie;
    }
    
    public function createHeadersBag()
    {
        $headers = new \Underwear\Component\Bag();
    
        foreach ($_GET as $key=>$value) {
            $headers->add($key,$value);
        }
        
        return $headers;
    }

}