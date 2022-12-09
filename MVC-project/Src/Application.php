<?php
namespace Src;

use Dotenv\Dotenv;
use Src\Http\Request;
use Src\Http\Response;
use Src\Http\Route;

class Application{
    public Request $request;
    public Response $response;
    public Route $route;
    public $env;
    protected static $app= null;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request , $this->response);
        $this->env = Dotenv::createImmutable(base_path());

        // if(! self::$app){
        //     self::$app = new Application;
        // }
        // return self::$app;
    }

    public static function getInstance()
    {
        if(! self::$app){
                self::$app = new Application;
            }
            return self::$app;
    }

    public function run()
    {
        $this->env->safeLoad();
        $this->route->resolve();
    }
}
