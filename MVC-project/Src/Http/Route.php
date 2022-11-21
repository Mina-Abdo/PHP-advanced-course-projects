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

        $action = self::$routes[$method][$url] ?? null;
        // error handling
        $this->errorHandle($url , $method);
        $this->actionHandle($action , $data);

    }

    public function errorHandle(string $url , string $method)
    {
        // dump(self::$routes);
        $routeFound = false;
        $is405 = false;
        foreach(self::$routes as $requestMethod => $requestUrl)
        {
            if(array_key_exists($url , $requestUrl)){
                $routeFound = true;
                if($requestMethod != $method){
                    $is405 = true;
                }
            }
        }

        if(! $routeFound){
            abort(404);
        }
        if($is405){
            abort(405);
        }
    }

    public function actionHandle(callable | array | string | null $action , array $data)
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