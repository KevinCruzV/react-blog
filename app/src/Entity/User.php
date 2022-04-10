<?php

namespace App\Entity;

class User
{
    private int $user_id;
    private string $username;
    private string $password;
    private string $token;


    public function __construct($username, $password, $token)
    {
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
        
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->user_id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->user_id = $id;
    }

   


    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}