<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// spl_autoload_register();
require __DIR__.'/vendor/autoload.php';

// load important files
require_once 'library/helpers.php';
require_once 'library/routes.php';

use Library\Router;

$router = new Router();
$router->init();