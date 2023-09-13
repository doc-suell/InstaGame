<?php

class Database{
    private string $username = "root";
    private string $password = "";
    private string $host = "localhost";
    private string $db_name = "instagame_perso";
    private $conn;



    function __construct($username = "root", $password = "", $host = "localhost", $db_name = "instagame_perso"){
        try{
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected";
        }
        catch(PDOException $e){
           echo " Connexion failed " . $e->getMessage();
        }   
    }

    public function getConnection(){
        return $this->conn; // Renvoie l'objet de connexion PDO
}


    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of host
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the value of db_name
     */ 
    public function getDb_name()
    {
        return $this->db_name;
    }

    /**
     * Get the value of conn
     */ 
    public function getConn()
    {
        return $this->conn;
    }
}