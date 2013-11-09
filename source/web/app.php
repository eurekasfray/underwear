<?php

// Perfect, not need to be change!

define ("ENVIRONMENT_PATH", realpath(dirname("..\..")));

require_once ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "config.php";
require_once COMPONENT_DIRECTORY . DIRECTORY_SEPARATOR . "Bootstrap" . FILE_EXTENSION;
//require_once INCLUDE_DIRECTORY . DIRECTORY_SEPARATOR . "autoload" . FILE_EXTENSION;

use Underwear\Component;

$bootstrap = new \Underwear\Component\Bootstrap();
$bootstrap->loadComponents();
$bootstrap->loadServices();

$kernel = new \Underwear\Component\Kernel();
$kernel->boot();
$request = \Underwear\Component\Request::compose();
$response = $kernel->handle($request);
$response->send();
$kernel->shutdown();

?>