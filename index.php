<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register();

// load important files
require_once 'Library/helpers.php';
require_once 'Library/routes.php';

use Library\Router;

$router = new Router();
$router->init();