<?php

namespace CRUD\Helper;

use Exception;
use PDO;
use PDOException;

class DBConnector
{

    /** @var mixed $db */
    private PDO $db;

    public function __construct()
    {
        $this->db = $this->connect();
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=myDB", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            $this->exceptionHandler($e->getMessage());
            return null;
          }
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {
        return true;
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
        echo $message;
    }

    public function getDB() {
        return $this->db;
    }
}