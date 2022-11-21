<?php
namespace Src\Resources;

class View{
    public static function make (string $viewPath , array $data = [])
    {
        // get base view
        // get title , content
        // get content view
        // get title , content
        $baseView =  self::getBaseView();
        $contentView =  self::getContentView( $viewPath , $data );
        echo self::mixer($baseView , $contentView);
    }

    public static function makeError($statusCode)
    {
        $path = resource_error_path("{$statusCode}.php");
        if(file_exists($path)){
            include $path; 
        }else{
            throw new \Exception("{$statusCode}.php not found in" . resource_path());
        }
    }

    public static function mixer($baseView , $contentView){
        $baseViewVars = self::baseViewVars($baseView);
        $contentViewVars = self::contentViewVars($contentView);
        // dd($baseViewVars , $contentViewVars);
        for ($i=0 ; $i < count($baseViewVars) ; $i++)
        {
            $baseView = str_replace($baseViewVars[$i] , $contentViewVars[$baseViewVars[$i]] ?? '' , $baseView);
        }
        return $baseView;
    }

    public static function baseViewVars($baseView){
        return self::getVars($baseView , "{{" , '}}')[0];
    }

    public static function contentViewVars($contentView){
        $contentViewVars = self::getVars($contentView , "{{" , '}}')[1];
        $contentViewVarsValues = [];
        foreach($contentViewVars as $value){
            $k = strtok($value , '=');
            $v = substr($value , strpos($value , '=')+1);
            $contentViewVarsValues["{{{$k}}}"] = $v;
        }
        return $contentViewVarsValues;
    }

    public static function getBaseView()
    {
        ob_start();
        include resource_layout_path('app.php');
        return ob_get_clean();
    }

    public static function getContentView(string $viewPath , array $data = [])
    {
        ob_start();
        foreach($data as $key=>$value){
            $$key = $value;
        }
        include resource_view_path(self::viewPathRebuilder($viewPath));
        return ob_get_clean();
    }

    public static function viewPathRebuilder($viewPath)
    {
        if(str_contains($viewPath , '.')){
            $viewPath = str_replace('.' , ds() , $viewPath);
        }
        $viewPath.= ".php";
        return $viewPath;
    }

    public static function getVars(string $str , $startWord , $endWord)
    {
        preg_match_all("/$startWord(.*?)$endWord/" , str_replace("\r\n" , '' , $str) , $matches);
        return $matches;
    }
}