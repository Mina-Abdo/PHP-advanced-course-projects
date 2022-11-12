<?php 
namespace Src\Http;

class Route {
    private static array $routes = []; 
    public function __construct(public Request $request ,public Response $response) {

    }
    public static function get(string $url ,callable|array|string $action)
    {
        url_slash_handle($url);
        self::$routes['get'][$url] = $action;
    }
    public static function post(string $url ,callable|array|string $action)
    {
        url_slash_handle($url);
        self::$routes['post'][$url] = $action;
    }


    public function resolve()
    {
        dd(self::$routes);
        $method = $this->request->method();
        $url = $this->request->url();
        $data = $this->request->all();
        dd($url);

        $action = self::$routes[ $method ][ $url ];
        // errors (404,405)
        foreach(self::$routes as $routeType){
            foreach($routeType as $route){
                if(! $url == $route){
                    echo "error 404";
                }elseif(! $routeType == $method ){
                    echo "error 405";
                }else{
                    
                }
            }
        }
        $this->actionHandle($action,$data);
    }

    private function actionHandle(callable|array|string $action ,array $data)
    {
        if(is_callable($action)){
            call_user_func_array($action,[$data]);
        }elseif(is_array($action)){
            call_user_func_array([new $action[0],$action[1]],[$data]);
        }else{
            $action = explode('@',$action);
            call_user_func_array([new $action[0],$action[1]],[$data]);
        }
    }

}

