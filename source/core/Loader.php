<?php

namespace Underwear\Core;

class Loader
{

    // This loader should be able to search through directories to find files. The search should not be recursive, but in cascade where it searches each directory's at one level for the file in search
	
    public static function load($path)
    {
        require_once $path;
    }    
    
}

?>
