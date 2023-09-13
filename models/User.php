<?php

class User {
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $profilePicture;
    private string $registrationDate;
   

    // Constructeur
    public function __construct(?int $id ,  $username, $email, $password, $profilePicture,$registrationDate) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
        $this->registrationDate = $registrationDate;
        
    }

    public static function getUser(){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT * FROM user');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById(int $id){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM user WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByUsername(string $username){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM user WHERE username = $username");
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByEmail(string $email){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT * FROM user WHERE email = ?');
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function addUser(string $username, string $email, string $password, string $profilePicture){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('INSERT INTO user (username, email, password, profilePicture) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $email, $password, $profilePicture]);
    }

    public static function updateUser(int $id, string $username, string $email, string $password, string $profilePicture){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE user SET username = ?, email = ?, password = ?, profilePicture = ? WHERE id = ?');
        $stmt->execute([$username, $email, $password, $profilePicture, $id]);
    }

    public static function deleteUser(int $id){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('DELETE FROM user WHERE id = ?');
        $stmt->execute([$id]);
    }

     
    // Méthodes getters
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRegistrationDate(): string {
        return $this->registrationDate;
    }

    public function getProfilePicture(): string {
        return $this->profilePicture;
    }

    // Méthodes supplémentaires
    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of registrationDate
     *
     * @return  self
     */ 
    public function setRegistrationDate(string $registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Set the value of profilePicture
     *
     * @return  self
     */ 
    public function setProfilePicture(string $profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

}












