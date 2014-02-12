<?php

namespace Underwear\Component;

class Helper
{

    public static function trimWhitespace($subject)
    {
        $space = " ";
        $horizontal_tab = "\t";
        $vertical_tab = "\v";
        $newline = "\n";
        $carriage_return = "\r";
        $null_character = "\0";
        $forward_slash = "/";
        
        $result = trim( $subject, $space . $horizontal_tab . $vertical_tab . $newline . $carriage_return . $null_character . $forward_slash );
        
        return $result;
        
    }

}