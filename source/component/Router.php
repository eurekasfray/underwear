<?php

namespace Underwear\Component;

class Router
{

    // A router registers to only one table.
    
    private $registry;
    
    public function register(\Underwear\Component\RouteTable $routeTable)
    {
        $this->registry = $routeTable;
    }

    public function getController($uri)
    {
        $controller = $this->search($uri);
        return $controller;
    }
    
    public function search($uri)
    {
        // TODO
        // - Make sure to match the selected METHOD to the right controller
        
        $found = false;
        
        $registry = $this->registry;
        $routeTable = $registry->getTable();
        $args = array();
        foreach ($routeTable as $name=>$route) {
            // The complex matching of URI and route path is done here. Replace this simple one:
            if ($this->match($uri, $route->getPath())) {
                $foundRoute = $route;
                $args = $this->getArgs($uri, $route->getPath());
                $found = true;
                break;
            }
        }
        
        if ($found) {
            $controller = array ("controller"=>$foundRoute->getController(), "action"=>$foundRoute->getAction(), "args"=>$args);
            return $controller;
        }
        else {
            return false;
        }
    }
    
    private function match($uri,$path)
    {
        // TODO
        // - When comparing parts, remember to consider case-sensitivity for those routes that are case-sensitive and those that are not
        // - What about query strings? Are are those to be handled? Should they be truncated from from the URI or should they be included? I think they should be truncated. The query strings start at the occurrence of the first question mark. But this still bothers me though. -- Okay turns out that query strings are handled by the server as my attempt to truncate the query strings from the uri in the uri-to-path match method caused an upset in the system, where regardless of the uri, the homepage was displayed, with the exception of the uri from which the query strings were truncated
        // ISSUES
        // - When the programmer types a path and say they type "/post/{id}{slug}", an error will come up to say that that is no match, because "{id/{slug}" is not a valid part. The problem is that an error will be returned to say that there is no match, even though user requested uri "/post/1234" is actually valid but the system will return a no-match error (not found), when actually the problem is not that the URI does not exist; the problem is that the programmer made an error in typing an syntactically incorrect path. So, question is, how do I handle syntax errors in paths properly? Do I use exceptions?
        
        // Clean up the uri and path
        $uri = trim($uri," \t\n\r\0\x0B/");
        $path = trim($path," \t\n\r\0\x0B/");
        
        // Divide the uri and path into parts
        $uriParts = explode("/", $uri);
        $pathParts = explode("/", $path);
        
        // Does uri and path match in their number of parts? If they do not match, we have an error!
        if (count($uriParts) != count($pathParts)) {
            return false;
        }
        
        // Match each corresponding part for the uri and path
        $error = false;
        foreach ($pathParts as $key=>$value) {
            if ($this->isPlaceholder($value) || ($value == $uriParts[$key])) {
                continue;
            }
            else {
                $error = true;
                break;
            }
        }
        
        if ($error) {
            return false;
        }
        else {
            return true;
        }
    }
    
    private function getArgs($uri,$path)
    {
        $uri = trim($uri," \t\n\r\0\x0B/");
        $path = trim($path," \t\n\r\0\x0B/");
        
        $uriParts = explode("/", $uri);
        $pathParts = explode("/", $path);
        
        $args = array();
        foreach ($pathParts as $key=>$value) {
            if ($this->isPlaceholder($value)) {
                $id = $this->extractIdentifier($value);
                $args[$id] = $uriParts[$key];
            }
        }
        
        return $args;
    }

    private function isPlaceholder($subject)
    {
        // A placeholder has the syntax a PHP identifier: It can only contain letters, numbers and an underscore, and must not begin with a number
        
        if (preg_match("/^{[A-Za-z_][A-Z-a-z0-9_]*}$/", $subject)) {
            return true;
        }
        else {
            return false;
        }
    }

    private static function extractIdentifier($placeholder)
    {
    
        // Extracts the identifier from the specified placeholder
        //
        // Example:
        //     extractIdentifier("{name}")
        //     Outputs: "name";
    
        $start = 1;                                 // we don't want the first either!
        $length = strlen($placeholder) - 2;         // neither do we want the last curly bracket
        $identifier = substr($placeholder, $start, $length);
        return $identifier;
    }

}

?>
