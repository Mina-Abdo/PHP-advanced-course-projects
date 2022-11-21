<?php

use Dotenv\Dotenv;
use Src\Http\Route;
use Src\Http\Request;
use Src\Http\Response;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require base_path('//Routes/web.php');

$dotenv = Dotenv::createImmutable(base_path());
$dotenv->safeLoad();

$obj = new Route(new Request , new Response);
$obj->resolve();



    


