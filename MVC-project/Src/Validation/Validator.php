<?php
namespace Src\Validation;

use Src\Validation\Rules\Contract\Rule;

class Validator{
    protected static array $data = [];
    protected static array $rules = [];
    protected static Message $messages; //we will make it a class as different operations will be made on it
    protected static ErrorBag $errorBag; //we will make it a class as different operations will be made on it
    public static function make(array $data , array $rules , array $messages =[] , array $attributes = [])
    {
        self::$data = $data;
        self::$rules = $rules;
        self::$messages = new Message($messages , $attributes);
        self::$errorBag = new ErrorBag;
        self::validate();
        return self::$errorBag;
    }

    public static function validate(){
        foreach(self::$rules as $field => $rules){
            foreach(RulesResolver::make($rules) as $rule){
                self::applyRule($field , $rule);
            }
        }
    }

    public static function applyRule($field , Rule $rule)
    {
        if(! $rule->apply($field , self::getfieldValue($field) , self::$data)){
            self::$errorBag->append($field , Message::generate($field , $rule));
        }
    }

    public static function getFieldValue(string $field){
        return self::$data[$field] ?? null;
    }

    
}