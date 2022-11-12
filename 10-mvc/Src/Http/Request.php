<?php 
namespace Src\Http;

class Request {
    public function all()
    {
        return $_REQUEST; // []
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function url()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
