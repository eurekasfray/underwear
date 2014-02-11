<?php

namespace Underwear\Component;

class Helper
{

    public static function trimWhitespace($subject)
    {
        define("SPACE"," ");
        define("HORIZONTAL_TAB","\t");
        define("VERTICAL_TAB","\v");
        define("NEWLINE","\n");
        define("CARRIAGE_RETURN","\r");
        define("NULL_CHARACTER","\0");
        define("FORWARD_SLASH","/");
        
        $result = trim($subject, SPACE . HORIZONTAL_TAB . VERTICAL_TAB . NEWLINE . CARRIAGE_RETURN . NULL_CHARACTER . FORWARD_SLASH );
        
        return $result;
        
    }

}