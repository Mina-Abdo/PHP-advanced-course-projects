<?php
namespace Src\Database\Grammers;

use Src\Database\Grammers\Contracts\DatabaseGrammer;

class MYSQLGrammer implements DatabaseGrammer{
    public static function buildSelectQuery(array $columns =['*'] , $filters=null)
    {
        //"SELECT * FROM users"
        //"SELECT id,email FROM users"
        //"SELECT id,email FROM users WHERE id = 1 AND status = ?"
        if($columns == ['*']){
            $databaseCoulmns = $columns[0];
            $query = "SELECT {$databaseCoulmns} FROM users";
        }else{
            $databaseCoulmns = implode("`, `" , $columns);
            $query = "SELECT `{$databaseCoulmns}` FROM users";
        }
        if($filters){
            $query.= self::buildWhereQuery($query , $filters);
        }
        return $query;
    }
    public static function buildInsertQuery(array $columns , $filters=null)
    {
        ['username' , 'password' , 'email'];
        "INSERT INTO users () VALUES ()";
        $columnsImploded = implode('`, `' , $columns);
        $questionMarks = implode(', ' , array_fill(1, count($columns),'?'));
        $query = "INSERT INTO users ({`$columnsImploded`}) VALUES ({$questionMarks})";
        return $query;
    }
    public static function buildUpdateQuery(array $columns , $filters=null)
    {
        //"UPDATE users SET id=1"
        //"UPDATE users SET id = 1 , status = 0 WHERE id=1 AND email=?"
        $query = "UPDATE users SET ";
        $query .= implode(" = ?, " , $columns) ." = ?";
        if($filters){
            $query .= self::buildWhereQuery($query , $filters);
        }
        return $query;
    }
    public static function buildDeleteQuery($filters=null)
    {
        $query = "DELETE FROM users ";
        if($filters){
            $query.= self::buildWhereQuery($query , $filters);
        }
        return $query;
    }
    public static function buildWhereQuery(string $query , array $filters)
    {
        $where = " WHERE ";
        if(is_array($filters[0])){
            foreach($filters as $index=>$filter){
                $where .= "`{$filter[0]}` {$filter[1]} ?";
                if($index != count($filters) -1){
                    $where .= " AND ";
                }
            }
        }else{
            $where .= "`{$filters[0]}` {$filters[1]} ?";
        }
        return $where;
    }
}

// where([['id' , '=' , '1'] , ['status' , '=' , '0']]) => WHERE id = ? AND status = ?
// where(['id' , '=' , '1']) => WHERE id = ?