<?php

abstract class Dao
{

    protected $connection;
    private string $dsn;
    private $options = [];
    private $file;
    protected string $sql;

    public function __construct()
    {
    }

    private function setFile()
    {
        $this->file = './database.ini';
    }

    private function getFile()
    {
        $this->setFile();

        if (empty($this->file)) {
            throw new Error("O arquivo do banco de dados está vazio!");
        }
        $this->file = parse_ini_file("database.ini");
        return $this->file;
    }

    private function setDsn()
    {
        $database = $this->getFile();

        $driver = $database["driver"];
        $dbname = $database["dbname"];
        $host = $database["host"];
        $port = $database["port"];

        $this->dsn = "$driver:host=$host;dbname=$dbname;port=$port";
    }

    private function getDsn()
    {
        $this->setDsn();
        return $this->dsn;
    }

    private function setOptions()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true,
            PDO::CASE_LOWER => true
        ];
        $this->options = $options;
    }

    private function getOptions()
    {
        $this->setOptions();
        return $this->options;
    }

    private function setConnection()
    {
        try {
            $database = $this->getFile();

            $username = $database["username"];
            $password = $database["password"];

            $dsn = $this->getDsn();
            $options = $this->getOptions();

            $connection = new PDO($dsn, $username, $password, $options);
            $this->connection = $connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getConnection()
    {
        $this->setConnection();
        return $this->connection;
    }

    protected function closeConnection()
    {
        $this->connection = null;
    }

    protected function validateQuery($result)
    {
        if ($result->rowCount() < 0) {
            throw new Error("Nenhum resultado encontrado!");
        }
        return $result->fetchAll();
    }

    // MAKE ALL QUERY'S IN DATABASE
    protected function runQuery($query, $parameters = null)
    {
        try {
            $this->getConnection();

            if($parameters != null){
                $stmt = $this->connection->prepare($query);
                $stmt->execute($parameters);
                $result = $stmt;
            } else 
            {
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                $result = $stmt;
                
            }
        } catch (PDOException $e) {     
            $result = "SQL STATE: " . $e->getCode();
            return $result;
        }

        $this->closeConnection();
        return $this->validateQuery($result);
    }
}
