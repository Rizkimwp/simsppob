<?php
// app/Services/AuthService.php

namespace App\Services;

use CodeIgniter\Session\Session;

class AuthService
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function isLoggedIn()
    {
        return $this->session->get('isLoggedIn') ?? false;
    }
}
