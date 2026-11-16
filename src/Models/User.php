<?php

namespace App\Models;

class User
{
    private string $name;
    private string $email;
    private string $passwordhash;

    public function __construct(string $name, string $email, string $passwordhash)
    {
        $this->name = $name;
        $this->email = $email;
        $this->passwordhash = $passwordhash;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }


}
