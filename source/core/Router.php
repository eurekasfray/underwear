<?php

namespace Underwear\Core;

class Router
{
    
    private $registry; // The route table. A router may only be registered to one table.
    
    // Register the given route table into the router's registry
    
    public function register(\Underwear\Core\RouteTable $routeTable)
    {
        $this->registry = $routeTable;
    }

    // Get the controller to which the given URI path and request method are mapped. This function is a candy wrapper for Router->search().
    
    public function getController($uriPath,$method)
    {
        $controller = $this->search($uriPath,$method);
        return $controller;
    }
    
    // Search the route table for the given URI path and request method. Upon finding a match, get the controller info (controller name, action name, and arguments that are collected from the given URI) and return this controller info.

    public function search($uriPath,$method)
    {            
        // Get the route table from the registry; then, get the table records from the retrieved route table
        
        $routeTable = $this->registry;
        $records = $routeTable->getRouteRecords();
        
        // Find the default route, if any, and save it before attempting to search for any other routes. In case the URI path in question is not found, the default route shall be fallen back onto. To do this, walk through the table records in search for the default route
        
        $foundDefaultRoute = false;
        foreach ($records as $name=>$route) {
            if (strtolower($name) == strtolower(DEFAULT_ROUTE_NAME)) {
                $foundDefaultRoute = true;
                $defaultRoute = $route;
                break;
            }
        }
        
        // In the following code paragraph: for the given URI, find the route to which the URI is mapped.
        
        $args = array();
        $foundOptionalRoute = false;
        foreach ($records as $name=>$route) {
            if ( $this->match( $uriPath, $route->getPath(), $route->getCaseSensitivity() ) ) {
                if (strtolower($route->getMethod()) == strtolower($method)) {
                    $foundOptionalRoute = true;    // yes, found it!
                    $optionalRoute = $route;
                    $args = $this->getArgs($uriPath, $route->getPath());
                    break;
                }
            }
        }
        
        // Return found route. However, if no route was found, then return default route. And if there is no default route, return null.
        
        if ($foundOptionalRoute) {
            $controller = new \Underwear\Core\Controller();
            $controller->setName( $optionalRoute->getController() );
            $controller->setAction( $optionalRoute->getAction() );
            $controller->setArgs( $args );
        }
        else {
            if ($foundDefaultRoute) {
                $controller = new \Underwear\Core\Controller();
                $controller->setName( $defaultRoute->getController() );
                $controller->setAction( $defaultRoute->getAction() );
                $controller->setArgs( array() );
            }
            else {
                $controller = null;
            }
        }
        
        return $controller;
        
    }
    
    // Match the URI path and route path. Are they equal to each other?
    
    private function match($uriPath, $routePath, $caseSensitivity)
    {
        // ISSUES
        // - When the programmer types a path and say they type "/post/{id}{slug}", an error will come up to say that that is no match, because "{id}{slug}" is not a valid part. The problem is that an error will be returned to say that there is no match, even though user requested URI "/post/1234" is actually valid but the system will return a no-match error (not found), when actually the problem is not that the URI does not exist; the problem is that the programmer made an error in typing a syntactically incorrect path. So, question is, how do I handle syntax errors in paths properly? Do I use exceptions?
        
        // Explode the URI path and route path into parts. Parts are separated by the forward slash ('/').
        
        $uriPathParts = explode("/", $uriPath);
        $routePathParts = explode("/", $routePath);
        
        // Does the URI path and route path match equally in their number of parts? If they do not match, then we have an error; this suggests that the URI path and the route path are not equal
        
        if (count($uriPathParts) != count($routePathParts)) {
            return false;
        }
        
        // In the following sequence of code, each corresponding part for the URI path and route path are matched. In other words, in a imperavtive tone: For each corresponding parts of the URI path and the route path, match each individual part in order to see if, in a bigger picture, the given URI path is the same as the given route path. URI path and route path are considered matched when the error indicator indicates that there was no error. The error indicator is set when, either, a part is not a valid placeholder and when the two corresponding parts string are not equal. The case-sensitivity of the route path is indicated by the argument $caseSensitive.
        
        $error = false;
        foreach ($routePathParts as $key=>$value) {
            if ($caseSensitivity == CASE_INSENSITIVE) {
                if ($this->isPlaceholder($value) || (strtolower($value) == strtolower($uriPathParts[$key]))) {
                    continue;
                }
                else {
                    $error = true;
                    break;
                }
            }
            else {
                if ($this->isPlaceholder($value) || ($value == $uriPathParts[$key])) {
                    continue;
                }
                else {
                    $error = true;
                    break;
                }
            }
        }
        
        // If a match was not found, then report the failure; otherwise, report success.
        if ($error) {
            return false;
        }
        else {
            return true;
        }
    }
    
    // This function collects the arguments from the URI using corresponding placeholders in the route path.
    
    private function getArgs($uriPath,$routePath)
    {   
        // Explode the given URI path into parts, and do the same to the
        // route path. Parts are separated by the forward slash ('/').
        
        $uriPathParts = explode("/", $uriPath);
        $routePathParts = explode("/", $routePath);
        
        // Go through each corresponding part of the URI path and route path.
        // Collect arguments from the URI path where indicated by placeholders
        // in the route path. The placeholders in the route path are used
        // as indicators of where the arguments in the URI path are located.
        // To accomplish this, check each exploded part iteratively. Upon each
        // iteration for each part, carry out the following:
        //
        // For each part, for each iteration, parse the current part. Once the
        // placeholder syntax parser says that the part that was given to it is
        // a valid placeholder, then two things should happen: First, capture
        // and store the name of the placeholder (because its needed for later).
        // Second, capture and store the URI part that corresponds to route path
        // of the placeholder in question. Do this until there are no more parts
        // to check.
        //
        // Remember the two pieces of data that were captured? We need both pieces
        // of data in order to make up the arguments that shall be passed as
        // controller arguments. The name of the placeholder that was capture
        // serves as the variable name for the argument; and then the value
        // captured is used as the value of the variable to be passed to the argument. 
        
        $args = array();
        foreach ($routePathParts as $i=>$part) {
            if ($this->isPlaceholder($part)) {
                $varname = $this->extractPlaceholderIdentifier($part);
                $args[$varname] = $uriPathParts[$i];
            }
        }
        
        return $args;
    }

    private function isPlaceholder($subject)
    {
        // A placeholder has a syntax of a your typical identifier. It can only
        // contain letters, numbers and an underscore, and must not begin with
        // a number. The body of the identifier is enclosed by opening
        // and closing curly brackets.
        
        $syntax = "/^{[A-Za-z_][A-Za-z0-9_]*}$/";
        
        if (preg_match($syntax, $subject)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function extractPlaceholderIdentifier($placeholder)
    {
    
        // Extracts the name from the specified placeholder. This function basically strips away the curly brackets from the identifier body.
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
