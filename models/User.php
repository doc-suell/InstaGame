<?php

include_once "./config/database.php";

class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $profilePicture;
    private string $registrationDate;

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

    public static function addUser(string $username, string $email, string $password, string $profilePicture, Database $db)
    {
        $stmt = $db->getConnection()->prepare('INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $email, $password, $profilePicture]);
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
