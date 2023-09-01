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












