<?php
namespace Src\Validation\Rules;

use Src\Validation\Rules\Contract\Rule;

class BetweenRule implements Rule{

    public function __construct(private $min , private $max)
    {
        
    }
    public function apply($field , $value , $data) :bool
    {
        return strlen($value) <=$this->max && strlen($value) >= $this->min ;
    }
    public function message() :string
    {
        return ":attribute must be between {$this->min} and {$this->max} charcters";
    }
    public function __tostring() :string
    {
        return 'between';
    }
}