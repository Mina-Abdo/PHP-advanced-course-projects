<?php
namespace Src\Validation\Rules\Contract;

interface Rule{
    public function apply($field , $rule , $data) :bool;
    public function message() :string;
    public function __tostring() :string; // invoked automatically when we deal the object as string
}