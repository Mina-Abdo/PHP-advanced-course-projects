<?php
namespace Src\Database\Concerns;

use Src\Database\Managers\Contracts\DatabaseManager;

class ConnectTo {
    public static function connect(DatabaseManager $databaseManager) :\PDO
    {
        return $databaseManager->connect();
    }
}