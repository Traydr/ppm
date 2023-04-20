<?php

class db {
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;

    private PDO $connection;


    public function __construct() {
        // Setting vars here is insecure, but since its for a local db it's fine
        $this->host = "localhost:3306";
        $this->dbname = "ppm";
        $this->username = "root";
        $this->password = "C2eK3NdGBkdvBJVXhhK9";

        // Attempts to start a connection
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password, array(
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $pe) {
            die ("Could not connect to the database $this->dbname :" . $pe->getMessage());
        }
    }

    /**
     * @return PDO Database connection
     */
    public function getConnection(): PDO {
        return $this->connection;
    }

    public function __destruct() {
        // According to https://www.php.net/manual/en/pdo.connections.php
        // This is the proper way to close a connection
        // $this->connection = null;

        unset($this->connection);
    }
}