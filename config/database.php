<?php


class Database
{
    private string $username = "root";
    private string $password = "";
    private string $host = "localhost";
    private string $db_name = "instagame";
    private static $instance = null;
    private $conn;



    function __construct($username = "root", $password = "", $host = "localhost", $db_name = "instagame_perso")
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected";
        } catch (PDOException $e) {
            echo " Connexion failed " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getDb_name()
    {
        return $this->db_name;
    }

    public function getConn()
    {
        return $this->conn;
    }
}
