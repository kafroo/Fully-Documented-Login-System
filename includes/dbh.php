<?php 

class Dbh {
    private $servername;
    private $username;
    private $password;
    private $dbname; 
    private $charset;
    public  $conn;

    public function connect() {
        $this->servername = "localhost";
        $this->username   = "root";
        $this->password   = "";
        $this->dbname     = "UsingPdo";
        $this->charset    = "utf8mb4";

        try{
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname. ";charset=".$this->charset;            // Data Source Name
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "Connection Failed:".$e->getMessage();
        }
        
    }
}
$database = new Dbh;
$database->connect();

function db()
{
    return $GLOBALS['database']->conn;
}