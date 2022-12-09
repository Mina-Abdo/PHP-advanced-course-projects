<?php
namespace Src\Validation\Rules;

use Src\Validation\Rules\Contract\Rule;

class AlphaNumericalRule implements Rule{
    public function apply($field , $value , $data) :bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9_]*$/' , $value);
    }
    public function message() :string
    {
        return ':attribute must be characters or numbers only';
    }
    public function __tostring() :string
    {
        return 'alnum';
    }
}