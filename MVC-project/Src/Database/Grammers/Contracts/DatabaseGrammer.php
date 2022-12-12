<?php
namespace Src\Database\Grammers\Contracts;

interface DatabaseGrammer{
    static function buildSelectQuery(array $columns , $filters=null);
    static function buildInsertQuery(array $columns , $filters=null);
    static function buildUpdateQuery(array $columns , $filters=null);
    static function buildDeleteQuery($filters=null);
    static function buildWhereQuery(string $query , array $filters);
}