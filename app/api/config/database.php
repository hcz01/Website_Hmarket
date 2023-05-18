<?php
// used to get mysql database connection
class DatabaseService
{
    private $host = "localhost";
    private $db_name = "hmarket";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
    
?>