<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

// load important files
require_once 'library/helpers.php';
require_once 'library/routes.php';

use Library\Router;

Router::init();