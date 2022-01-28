# online-users-php
Proof of concept for seeing online users | built with PHP

## Installation

Noothing special needed, just make sure you have the latest PHP version install on your local machine/server then run ```php -S localhost:8000```

## Project setup

This project was designed with MVC in mind, inspired by architecture of modern frameworks.

Entry file is index.php, which then initiates the Router class to handle routing.

You can find regisetered routes in /library/routes.php

There are some helper functions used throughout the project found in /library/helpers.php 

Rest of the files are normal MVC structure, however we do not have a VIEW here since this project serves as an API server.