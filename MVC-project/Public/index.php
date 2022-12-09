<?php

use Src\Validation\Validator;
use Src\Validation\Rules\RequiredRule;
use Src\Validation\Rules\AlphaNumericalRule;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require base_path('//Routes/web.php');


app()->run();

$data = [
    "first_name"=>"mina",
    'password'=>'12345'
];

$rules = [
    'first_name'=>'required|min:2',
    'password'=>['required' , 'between:4,6']
];

$messages = [];

$attributes = [];


$validator = Validator::make($data , $rules , $messages , $attributes);

if($validator->fails()){
    dd($validator->allErrors());
}
