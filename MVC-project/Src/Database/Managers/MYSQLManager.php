<?php
namespace Src\Database\Managers;

use Src\Database\Grammers\MYSQLGrammer;
use Src\Database\Managers\Contracts\DatabaseManager;

class MYSQLManager implements DatabaseManager{
    private static $instance = null;
    public function connect() :\PDO
    {
        if(! self::$instance){
            $connectionStmt = env("DB_DRIVER").":host=".env('DB_HOST').";dbname=".env('DB_DATABASE').";port=".env("DB_PORT");
            self::$instance = new \PDO($connectionStmt,env('DB_USERNAME'),env('DB_PASSWORD'));        
        }
        return self::$instance;
    }
    public function raw(string $query , array $values)
    {
        //
    }
    public function creat(array $data)
    {
        $query = MYSQLGrammer::buildInsertQuery(array_keys($data));
        $stm = self::$instance->prepare($query);
        foreach($data as $index=>$value){
            $stm->bindValue($index+1 , $value);
        }
        return $stm->excute();
    }
    public function read(array $columns = ['*'] , $filters = null)
    {
        //
    }
    public function update(array $data , $filters = null)
    {
        //
    }
    public function delete($filters = null)
    {
        //
    }
}