<?php

use Underwear\Component;

$routeTable = new \Underwear\Component\RouteTable();
$routeTable->add("testpage", new \Underwear\Component\Route("/user/{name}","Homepage","show","GET"));
$routeTable->add("testpage", new \Underwear\Component\Route("/","Homepage","showPage","GET"));

return $routeTable;

?>
