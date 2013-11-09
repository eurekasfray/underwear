<?php

use Underwear\Component;

$table = new \Underwear\Component\RouteTable();
$table->add("homepage", new \Underwear\Component\Route("/","Homepage","show","GET"));

return $table;

?>
