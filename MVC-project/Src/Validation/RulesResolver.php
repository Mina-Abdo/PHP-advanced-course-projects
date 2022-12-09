<?php
namespace Src\Validation;

class RulesResolver {
    public static function make(array|string $rules) :array
    {
        if(is_string($rules)){
            $rules = self::convertStringRulesToArray($rules);
        }
        return array_map(function ($rule){
            if(is_string($rule)){
                return self::getRuleFromString($rule);
            }
            return $rule;
        } , $rules);
    }

    public static function getRuleFromString($rule){
        $args=[];
        if(str_contains($rule , ':')){
            $exploded=explode(':' , $rule);
            $args = explode(',' , $exploded[1]);
            $rule = $exploded[0] ;
        }
        return RulesMapper::resolve($rule , $args);
    }

    

    public static function convertStringRulesToArray($rules) :array
    {
        return explode('|' , $rules);
    }
}