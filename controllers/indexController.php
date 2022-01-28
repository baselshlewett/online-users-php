<?php

namespace Controllers;

use Controllers\Controller;

class indexController extends Controller
{
    public function index(): mixed
    {
        // simple function to check that our server is up and running as it should
        // php version can be ommitted from the response, we're just keeping it for debugging and/or general information
        return json(["status" => 200, "version" => "1.0", "php_version" => phpversion()]);
    }
}