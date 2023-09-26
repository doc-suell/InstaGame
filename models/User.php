<?php

include_once "../config/database.php";

class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private ?string $profilePicture;
    private ?string $registrationDate;

    // Constructeur
    public function __construct(?int $id,  $username, $email, $password, $profilePicture, $registrationDate)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
        $this->registrationDate = $registrationDate;
    }

    public static function getUser(Database $db)
    {
        $stmt = $db->getConnection()->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getsById(int $id, Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM users WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // public static function login($username, $password, Database $db)
    // {
    //     $stmt = $db->getConnection()->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public static function login($username, $password, Database $db)
    {
        // Préparez la requête SQL avec des paramètres liés
        $stmt = $db->getConnection()->prepare("SELECT id FROM users WHERE username = :username AND password = :password");
        
        // Liez les valeurs aux paramètres
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        // Exécutez la requête
        $stmt->execute();
        
        // Récupérez le résultat sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Si l'authentification réussit, retournez l'ID de l'utilisateur
            return $result['id'];
        } else {
            // Si l'authentification échoue, retournez false
            return false;
        }
    }

    public static function getsByUsername(string $username, Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM users WHERE username = '$username'");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByEmail(string $email, Database $db)
    {
        $stmt = $db->getConnection()->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function addUser(string $username, string $email, string $password, Database $db)
    {
        $stmt = $db->getConnection()->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $password]);
    }

    public static function updateUser(int $id, string $username, string $email, string $password, string $profilePicture, Database $db)
    {
        $stmt = $db->getConnection()->prepare('UPDATE users SET username = ?, email = ?, password = ?, profile_picture = ? WHERE id = ?');
        $stmt->execute([$username, $email, $password, $profilePicture, $id]);
    }

    public static function deleteUser(int $id, Database $db)
    {
        $stmt = $db->getConnection()->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function usernameExists(string $username, Database $db) {
        $stmt = $db->getConnection()->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public static function emailExists(string $email, Database $db) {
        $stmt = $db->getConnection()->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    // Méthodes getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    public function getProfilePicture(): string
    {
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
