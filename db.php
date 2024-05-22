<?php
/*
Simple creation of the database connection; studying the singleton pattern is relevant.
*/

class DbConnect
{

    public function __construct(private string $db, private string $user,private string $password) {
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;
    }

    public function getPDO()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=' . $this->db , $this->user, $this->password);

        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
        }
    }
}