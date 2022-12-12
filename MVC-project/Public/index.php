<?php

use Src\Database\Managers\MYSQLManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require base_path('//Routes/web.php');


app()->run();

dd(env("APP_NAME"));
// dd($_ENV["APP_NAME"]);
$mysqlManager = new MYSQLManager;
$mysqlManager->connect();
$mysqlManager->creat(['username'=>"mina" , 'password'=>1234567]);
