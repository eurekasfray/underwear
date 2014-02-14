<?php

namespace Underwear\Component;

class Router
{
    // A router may only be registered to one table.
    
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
        // Create Abstract Request Object
        $abstractRequest = new \Underwear\Component\AbstractRequest();
    
        // Get The Route Table
        
        $registry = $this->registry;
        $routeTable = $registry->getTable();
        
        // Find default route first, in case the given URL is not found
        
        $foundDefaultRoute = false;
        foreach ($routeTable as $name=>$route) {
            if (strtolower($name) == DEFAULT_ROUTE_NAME) {
                $defaultRoute = $route;
                $foundDefaultRoute = true;
                break;
            }
        }
        
        // Find route match for given URL
        
        $found = false;
        $args = array();
        foreach ($routeTable as $name=>$route) {
            if ( $this->match($uri, $route->getPath(), $route->getCaseSensitivity()) ) {
                if (strtolower($route->getMethod()) == strtolower($abtsractRequest->getMethod())) {
                    $foundRoute = $route;
                    $args = $this->getArgs($uri, $route->getPath());
                    $found = true;
                    break;
                }
            }
        }
        
        // Return found route. However, if no route is found, then return default route if any
        
        if ($found) {
            $controller = array ("controller"=>$foundRoute->getController(), "action"=>$foundRoute->getAction(), "args"=>$args);
            return $controller;
        }
        else {
        
            if ($foundDefaultRoute) {
                $controller = array ("controller"=>$defaultRoute->getController(), "action"=>$defaultRoute->getAction(), "args"=>array());
            }
            else {
                $controller = false;
            }
            
            return $controller;
        }
        
    }
    
    private function match($uri,$path,$caseSensitive)
    {
        // TODO
        // - When comparing parts, remember to consider case-sensitivity for those routes that are case-sensitive and those that are not
        // - What about query strings? Are are those to be handled? Should they be truncated from from the URI or should they be included? I think they should be truncated. The query strings start at the occurrence of the first question mark. But this still bothers me though. -- Okay turns out that query strings are handled by the server as my attempt to truncate the query strings from the uri in the uri-to-path match method caused an upset in the system, where regardless of the uri, the homepage was displayed, with the exception of the uri from which the query strings were truncated
        // ISSUES
        // - When the programmer types a path and say they type "/post/{id}{slug}", an error will come up to say that that is no match, because "{id}{slug}" is not a valid part. The problem is that an error will be returned to say that there is no match, even though user requested uri "/post/1234" is actually valid but the system will return a no-match error (not found), when actually the problem is not that the URI does not exist; the problem is that the programmer made an error in typing a syntactically incorrect path. So, question is, how do I handle syntax errors in paths properly? Do I use exceptions?
        
        // Clean up the uri and path
        $uri = \Underwear\Component\Helper::trimWhitespace($uri);
        $path = \Underwear\Component\Helper::trimWhitespace($path);
        
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
        
            if (!$caseSensitive) {
                if ($this->isPlaceholder(\Underwear\Component\Helper::trimWhitespace($value)) || (strtolower($value) == strtolower($uriParts[$key]))) {
                    continue;
                }
                else {
                    $error = true;
                    break;
                }
            }
            else {
                if ($this->isPlaceholder(\Underwear\Component\Helper::trimWhitespace($value)) || ($value == $uriParts[$key])) {
                    continue;
                }
                else {
                    $error = true;
                    break;
                }
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
        $uri = \Underwear\Component\Helper::trimWhitespace($uri);
        $path = \Underwear\Component\Helper::trimWhitespace($path);
        
        $uriParts = explode("/", $uri);
        $pathParts = explode("/", $path);
        
        $args = array();
        foreach ($pathParts as $key=>$value) {
            $value = \Underwear\Component\Helper::trimWhitespace($value);
            if ($this->isPlaceholder($value)) {
                $id = $this->extractIdentifier($value);
                $args[$id] = $uriParts[$key];
            }
        }
        
        return $args;
    }

    private function isPlaceholder($subject)
    {
        // A placeholder has the syntax of a PHP identifier: It can only contain letters, numbers and an underscore, and must not begin with a number
        
        if (preg_match("/^{[A-Za-z_][A-Za-z0-9_]*}$/", $subject)) {
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
        //     outputs: "name";
    
        $start = 1;                                 // we don't want the first either!
        $length = strlen($placeholder) - 2;         // neither do we want the last curly bracket
        $identifier = substr($placeholder, $start, $length);
        return $identifier;
    }

}

?>
