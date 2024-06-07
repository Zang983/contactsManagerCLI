<?php
/*
Simple creation of the database connection; studying the singleton pattern is relevant.
*/

class DataBase
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        require_once ('configDB.php');
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=' . $mysql_database, $mysql_user, $mysql_password);
        } catch (PDOException $error) {
            throw new Exception('Error : ' . $error->getMessage());
        }
    }

    public static function getDB()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    /*
    Execute the provided query and return the result if there is one.
    */
    public function executeRequest(string $request, array $params = null)
    {
        $state = $this->pdo->prepare($request);
        $state->execute($params);
        return $state->fetchAll();
    }
    public function lastId()
    {
        return $this->pdo->lastInsertId();
    }
}