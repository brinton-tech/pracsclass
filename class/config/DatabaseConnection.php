<?php

class DatabaseConnection
{
    public function __construct()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(!$conn)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        echo "Database connected successfully";
        return $this->conn = $conn;
    }
}




?>