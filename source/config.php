<?php

// config.php: the framework configuration file.
//
// This file contains framework configuration globals. Configuration globals are applied across the entire framework; this inclusion covers the entire framework environment.

define ("APP_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "app");
define ("APP_CONTROLLER_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "controller");
define ("APP_TEMPLATE_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "template");
define ("APP_CONFIG_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "config");
define ("COMPONENT_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "component");
define ("INCLUDE_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "include");
define ("SERVICE_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "service");
define ("CORE_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "core");
define ("WEB_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "web");

// Extension of framework files

define ("FILE_EXTENSION", ".php");

// Route Case Sensitivity

define ("CASE_SENSITIVE", true);
define ("CASE_INSENSITIVE", false);

// Routing Configuration

define ("DEFAULT_ROUTE_NAME", "default");

?>
