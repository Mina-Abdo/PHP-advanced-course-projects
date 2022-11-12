<?php 

if(! function_exists('url_slash_handle')){
    function url_slash_handle(string &$url) :void{ // local
        if(! str_starts_with($url,'/')){
            $url = '/' . $url;
        }
    }
}
