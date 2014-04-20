<?php

// app.php: the front controller

// All requests to the server are redirected to this file by the htaccess file.
// This file, the front controller, is the port of entry for all requests
// (except when requests are for existing files and directories).
//
// The front controller that interacts directly with the client. It receives
// requests sent by the client, let's the application process the request,
// lets the application provide back to it a response, and then it sends back
// the response to the client.

// Get the real path of where this file is located on the server.

define ("ENVIRONMENT_PATH", realpath(dirname("..\..")));

// Require some important files that are needed to get started:
// the framework config and the boostrap

require_once ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "config.php";
require_once CORE_DIRECTORY . DIRECTORY_SEPARATOR . "Bootstrap" . FILE_EXTENSION;
//require_once INCLUDE_DIRECTORY . DIRECTORY_SEPARATOR . "autoload" . FILE_EXTENSION;

// Bootstrap the framework core, components, and services

$bootstrap = new \Underwear\Core\Bootstrap();
$bootstrap->loadCore();
$bootstrap->loadComponents();
$bootstrap->loadServices();

// In this paragraph of code below, we facilitates the interaction between
// the client and the application.
//
// To know what the client wants, we need to obtain the HTTP request. The HTTP
// request contains information about what the client wants. Once we get the
// HTTP request, we then hand the it to the kernel. The kernel's job here
// is to dispatch the app controller that corresponds to the request. Once the
// controller is found and dispatched, at the end of its run, the controller must
// provide a response (because the application is responsible for creating the
// responses). The returned response is then sent out to the client.

$kernel = new \Underwear\Core\Kernel();
$kernel->boot();
$request = new \Underwear\Component\HttpRequest();
$response = $kernel->handle($request);
$response->send();
$kernel->shutdown();

?>