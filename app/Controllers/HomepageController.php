<?php

namespace App\Controllers;
use App\Helpers\AuthHelper;
class HomepageController extends BaseController
{
    public function index(): string
    {

       // Memeriksa apakah pengguna sudah login
       
    
        return view('homepage/homepage');

    }
}