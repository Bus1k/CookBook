<?php

namespace app\core;

use PDO;

/**
 * Class Database
 *
 * @package app
 */
class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $name = DB_NAME;
    private int $port    = DB_PORT;

    private PDO $pdo;
    private $stmt;

    public function __construct()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname='.$this->name, $this->user, $this->pass);
            //throw exception if database connection problem
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Prepare statement with query
    public function query(string $sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    //Bind Values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    //Get results
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get single record
    public function single(){
        $this->execute();
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if($result === false) {
            return [];
        }

        return $result;
    }

    //Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}