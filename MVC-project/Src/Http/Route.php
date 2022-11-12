<?php
namespace Src\Http;

class Route{
    private static array $routes = [];
    public function __construct(public Request $request , public Response $response)
    {
        
    }

    public static function get (string $url , callable | array | string $action)
    {
        url_slash_handle($url);
        self::$routes['get'][$url] = $action;
    }

    public static function post (string $url , callable | array | string $action)
    {
        url_slash_handle($url);
        self::$routes['post'][$url] = $action;
    }

    public function resolve ()
    {
        $url = $this->request->url();
        $method = $this->request->method();
        $data = $this->request->all();

        $action = self::$routes[$method][$url];
        // error handling

        $this->actionHandle($action , $data);

    }

    public function actionHandle(callable | array | string $action , array $data)
    {
        if(is_callable($action)){
            call_user_func_array($action , $data);
        }
        if(is_array($action)){
            call_user_func_array([new $action[0] , $action[1]] , $data);
        }
        if(is_string($action)){
            $action = explode('@' , $action);
            call_user_func_array([new $action[0] , $action[1]] , $data);
        }
    }
}