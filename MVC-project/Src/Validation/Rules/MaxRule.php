<?php
namespace Src\Validation\Rules;

use Src\Validation\Rules\Contract\Rule;

class MaxRule implements Rule{

    public function __construct(private $max)
    {
        
    }
    public function apply($field , $value , $data) :bool
    {
        return strlen($value) <=$this->max ;
    }
    public function message() :string
    {
        return ":attribute must be less than {$this->max} charcters";
    }
    public function __tostring() :string
    {
        return 'max';
    }
}