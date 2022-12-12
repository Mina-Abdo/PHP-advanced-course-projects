<?php
namespace Src\Database\Managers\Contracts;

interface DatabaseManager{
    public function connect() :\PDO;
    public function raw(string $query , array $values);
    public function creat(array $data);
    public function read(array $columns = ['*'] , $filters = null);
    public function update(array $data , $filters = null);
    public function delete($filters = null);
}