<?php

// This needs work.
// I have an idea for it: It should check the component and service directory to automatically include any needed class as those two directories are where the major classes are stored and I don't think there will be any other place where other classes are stored ... wait... do we really need this autoload class?
//
// NEW! IMPORTANT
// Yes, actually, __autoload() is very important. Used with the Loader, which can search all directories that store the classes, it can be used to load any class.
// Like this:
//    function __autoload($className)
//    {
//        Loader::get($className . FILE_EXTENSION);
//    }
//
// Loader::get() searches all directories to find the wanted class.
// So with this, when the kernel dispatches a controller that hasn't been declared, __autoload() will automatically load the needed class.

function __autoload($className)
{
    include_once $className . "." . FILE_EXTENSION;
}

?>
