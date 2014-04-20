<?php

namespace Underwear\Core;

class Normalizer
{

    // Normalize URI path: remove fragment and query strings; a URI does not include them. The need to normalize the URI path comes the htaccess file requesting to the server to pass the URI, verbatim, without rewrite or change, which means that query strings are tagged along with the URI
    
    public function normalizePath($path)
    {
        // The normalization process includes:
        // - removing duplicate internal slashes  example: /foo//bar --> /foo/bar
        // - trimming outer whitespaces           example: ^^^/foo/bar/^^^ --> foo/bar      note: '^' represents any whitespace
        // - trimming outer slashes               example: /foo/bar// --> foo/bar
        // - removing query string                example: /show?page=home --> /show
        
        // Get query string and remove it from URI.
        // The reason for the query string still being appended to the URI
        // is this: the commands in the htaccess file in the "web" directory
        // tell the rewrite engine to pass through the entire URI as is,
        // and treat everything in the URI (including the query string)
        // as a URI; which all means that the rewrite engine passes the URI verbatim. As a result of this, the query string
        // needs to be trimmed off, or else the router will not be able to
        // match the URI path to a route path, because query strings are
        // not allowed in the route path.
        
        $indexof = strpos($path,'?');
        
        if ($indexof != false) {
            // $queryString = substr($path, ($indexof+1), (strlen($path)-1)); // get query string (but do we really need? what to do with it then?)
            $path = substr($path,0,$indexof);    // remove query string, and keep the URI path
        }
        
        // Trim the URI path of whitespace and slashes. I think that outer whitespaces and slashes offer no semantic to the URI path, but are rather makes the URI path and route path less equal in meaning and makes the two more semantically erroneous. Where the user might enter "user/username/" with a trailing slash, the developer may have the route path as "user/username" without the trailing slash. Without normalizing either paths, these two incompatible paths will produce an error, because they are no equal. That's the need to trim the whitespaces and trailing slashes.
        
        $path = trim( $path, "\s" . "/" );
        
        // The removal of duplicate internal slashes. In a URI, "/foo//bar" where there are duplicate internal slashes, I think there's a need to remove these internal slashes, because they offer no meaning to the path. And because of the specific type of syntax that route paths have where forward slashes are treated as separators of path parts, I find that removing duplicate internal slashes makes everything cleaner.
        
        // {Insert code to remove duplicate slashes here}
        
        return $path;
    }

}

?>