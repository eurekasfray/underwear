<?php

// Framework configuration globals. They are applied across the entire framework

define ("APP_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "app");
define ("APP_CONTROLLER_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "controller");
define ("APP_TEMPLATE_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "template");
define ("APP_CONFIG_DIRECTORY", APP_DIRECTORY . DIRECTORY_SEPARATOR . "config");
define ("COMPONENT_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "component");
define ("INCLUDE_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "include");
define ("SERVICE_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "service");
define ("WEB_DIRECTORY", ENVIRONMENT_PATH . DIRECTORY_SEPARATOR . "web");

define ("FILE_EXTENSION", ".php");

// Route Case Sensitivity

define ("CASE_SENSITIVE", true);
define ("CASE_INSENSITIVE", false);
?>
