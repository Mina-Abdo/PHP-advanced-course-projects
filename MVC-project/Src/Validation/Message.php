<?php
namespace Src\Validation;

//attributes = ['first_name'=>'first name',
// 'last_name'=>'last name']

//messages = ['first_name.required'=>'matsebsh el name fady',
// 'password.alnum'=>'elpassword 7roof w arkam bas']
class Message{
public static array $messages;
public static array $attributes;
    public function __construct(array $messages , array $attributes)
    {
        self::$messages = $messages;
        self::$attributes = $attributes;
    }

    public static function generate($field , $rule)
    {
        if(array_key_exists((string)$rule , self::$messages)){
            return self::$messages[(string)$rule];
        }
        if(array_key_exists($field . '.' . $rule , self::$messages)){
            return self::$messages[$field . '.' . $rule]; 
        }
        return str_replace(':attribute' , self::getAttrval($field) , $rule->message());
    }

    public static function getAttrval($field) :string
    {
        return self::$attributes[$field] ?? $field;
    }
}