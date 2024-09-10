<?php
// Include the Router class definition
require_once 'Router.php';

// Include and execute the routes file
$router = require 'routes.php';

// Get the current URI and HTTP method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remove query string from URI if present
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$router->handleRequest($method, $uri);

// Ensure script execution ends here
exit();
